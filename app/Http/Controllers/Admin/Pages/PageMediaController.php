<?php

namespace App\Http\Controllers\Admin\Pages;

use App\Models\PageSection;
use Illuminate\Http\UploadedFile;
use Intervention\Image\Facades\Image;
use Redirect;
use App\Models\Page;
use App\Http\Requests;
use App\Models\PageMedia;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\AdminController;
use Titan\Models\Traits\ImageThumb;

class PageMediaController extends AdminController
{
    /**
     * Show the form for creating a new pageMedia.
     *
     * @param Page $page
     * @return Response
     */
    public function create(Page $page)
    {
        return $this->view('pages.components.media')->with('page', $page);
    }

    /**
     * Store a newly created pageMedia in storage.
     *
     * @param Page $page
     * @return Response
     */
    public function store(Page $page)
    {
        $attributes = request()->validate(PageMedia::$rules, PageMedia::$messages);

        unset($attributes['page_id']);
        $media = $this->moveAndCreatePhoto($attributes['media']);
        if ($media) {
            $attributes['media'] = $media;
            $item = $this->createEntry(PageMedia::class, $attributes);
        }

        $page->attachComponent($item);

        return redirect_to_resource();
    }

    /**
     * Show the form for editing the specified pageMedia.
     *
     * @param Page      $page
     * @param PageMedia $medium
     * @return Response
     */
    public function edit(Page $page, PageMedia $medium)
    {
        return $this->view('pages.components.media')->with('page', $page)->with('item', $medium);
    }

    /**
     * Update the specified pageMedia in storage.
     *
     * @param Page      $page
     * @param PageMedia $medium
     * @return Response
     */
    public function update(Page $page, PageMedia $medium)
    {
        if (is_null(request()->file('media'))) {
            $attributes = request()->validate(array_except(PageMedia::$rules, 'media'),
                PageMedia::$messages);
        }
        else {
            $attributes = request()->validate(PageMedia::$rules, PageMedia::$messages);

            $media = $this->moveAndCreatePhoto($attributes['media']);
            if ($media) {
                $attributes['media'] = $media;
            }
        }

        unset($attributes['page_id']);
        $item = $this->updateEntry($medium, $attributes);

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
        $size = ['l' => [800, 800], 's' => [300, 300]]
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

            // resize the image to the large width and constrain aspect ratio (auto height)
            $imageTmp->resize($largeSize[0], null, function ($constraint) {
                $constraint->aspectRatio();
            })->save($path . $filename);

            // resize the image to the thumb width and constrain aspect ratio (auto width)
            $imageTmp->resize($thumbSize[0], null, function ($constraint) {
                $constraint->aspectRatio();
            })->save($path . $name . ImageThumb::$thumbAppend . $extension);
        }
        else {

            // resize the image to the large height and constrain aspect ratio (auto width)
            $imageTmp->resize(null, $largeSize[1], function ($constraint) {
                $constraint->aspectRatio();
            })->save($path . $filename);

            // resize the image to the thumb height and constrain aspect ratio (auto width)
            $imageTmp->resize(null, $thumbSize[1], function ($constraint) {
                $constraint->aspectRatio();
            })->save($path . $name . ImageThumb::$thumbAppend . $extension);
        }

        return $filename;
    }
}
