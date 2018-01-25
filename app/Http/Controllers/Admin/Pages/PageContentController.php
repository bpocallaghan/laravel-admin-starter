<?php

namespace App\Http\Controllers\Admin\Pages;

use Image;
use App\Models\Page;
use App\Http\Requests;
use App\Models\Content;
use App\Models\PageContent;
use Illuminate\Http\UploadedFile;
use App\Http\Controllers\Admin\AdminController;
use Titan\Models\Traits\ImageThumb;

class PageContentController extends AdminController
{
    /**
     * Show the form for creating a new content.
     *
     * @param Page $page
     * @return Response
     */
    public function create(Page $page)
    {
        // create new content (used to link media and documents to)
        $item = PageContent::create();

        return $this->view('pages.components.content')
            ->with('page', $page)
            ->with('item', $item);
    }

    /**
     * Show the form for editing the specified content.
     *
     * @param Page        $page
     * @param PageContent $content
     * @return Response
     */
    public function edit(Page $page, PageContent $content)
    {
        return $this->view('pages.components.content')
            ->with('page', $page)
            ->with('item', $content);
    }

    /**
     * Update the specified content in storage.
     *
     * @param Page        $page
     * @param PageContent $content
     * @return Response
     */
    public function update(Page $page, PageContent $content)
    {
        if (is_null(request()->file('media'))) {
            $attributes = request()->validate(array_except(PageContent::$rules, 'media'),
                PageContent::$messages);
        }
        else {
            $attributes = request()->validate(PageContent::$rules, PageContent::$messages);

            $media = $this->moveAndCreatePhoto($attributes['media']);
            if ($media) {
                $attributes['media'] = $media;
            }
        }

        unset($attributes['page_id']);
        $item = $this->updateEntry($content, $attributes);

        $page->attachComponent($item);

        return redirect_to_resource();
    }

    /**
     * Save Image in Storage, crop image and save in public/uploads/images
     * @param UploadedFile $file
     * @param array        $size
     * @return \Illuminate\Http\JsonResponse|static
     */
    private function moveAndCreatePhoto(
        UploadedFile $file,
        $size = ['l' => [1000, 1000], 's' => [300, 300]]
    ) {
        $extension = '.' . $file->extension();

        $name = token();
        $filename = $name . $extension;

        $path = upload_path_images();
        $imageTmp = Image::make($file->getRealPath());

        if (!$imageTmp) {
            return false;
        }

        $largeSize = $size['l'];
        $thumbSize = $size['s'];

        // save original
        $imageTmp->save($path . $name . ImageThumb::$originalAppend . $extension);

        // if width is the biggest - resize on max width
        if ($imageTmp->width() > $imageTmp->height()) {
            // resize the image to the large height and constrain aspect ratio (auto width)
            $imageTmp->resize(null, $largeSize[1], function ($constraint) {
                $constraint->aspectRatio();
            })->save($path . $filename);

            // resize the image to the thumb height and constrain aspect ratio (auto width)
            $imageTmp->resize(null, $thumbSize[1], function ($constraint) {
                $constraint->aspectRatio();
            })->save($path . $name . ImageThumb::$thumbAppend . $extension);
        }
        else {
            // resize the image to the large width and constrain aspect ratio (auto height)
            $imageTmp->resize($largeSize[0], null, function ($constraint) {
                $constraint->aspectRatio();
            })->save($path . $filename);

            // resize the image to the thumb width and constrain aspect ratio (auto width)
            $imageTmp->resize($thumbSize[0], null, function ($constraint) {
                $constraint->aspectRatio();
            })->save($path . $name . ImageThumb::$thumbAppend . $extension);
        }

        return $filename;
    }
}
