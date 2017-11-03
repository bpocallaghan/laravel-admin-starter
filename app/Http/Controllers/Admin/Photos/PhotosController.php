<?php

namespace App\Http\Controllers\Admin\Photos;

use Image;
use Redirect;
use App\Models\News;
use App\Models\Photo;
use App\Http\Requests;
use App\Models\Article;
use App\Models\PhotoAlbum;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Titan\Models\Traits\ImageThumb;
use App\Http\Controllers\Admin\AdminController;

class PhotosController extends AdminController
{
    /**
     * Display a listing of photo.
     *
     * @return Response
     */
    public function index()
    {
        save_resource_url();

        $items = Photo::with('photoable')->get();

        return $this->view('photos.index')->with('items', $items);
    }

    /**
     * Show the Photoable's photos
     * Create / Edit / Delete the photos
     * @param $photoable
     * @param $photos
     * @return mixed
     */
    private function showPhotoable($photoable, $photos)
    {
        save_resource_url();

        return $this->view('photos.create_edit')
            ->with('photoable', $photoable)
            ->with('photos', $photos);
    }

    /**
     * Show the News' photos
     * @param News $news
     * @return mixed
     */
    public function showNewsPhotos(News $news)
    {
        return $this->showPhotoable($news, $news->photos);
    }

    /**
     * Show the album's photos
     * @param PhotoAlbum $album
     * @return mixed
     */
    public function showAlbumPhotos(PhotoAlbum $album)
    {
        return $this->showPhotoable($album, $album->photos);
    }

    /**
     * Show the article's photos
     * @param Article $article
     * @return mixed
     */
    public function showArticlePhotos(Article $article)
    {
        return $this->showPhotoable($article, $article->photos);
    }

    /**
     * Upload a new photo to the album
     * @return \Illuminate\Http\JsonResponse
     */
    public function uploadPhotos()
    {
        // upload the photo here
        $attributes = request()->validate(Photo::$rules);

        // get the photoable
        $photoable = input('photoable_type')::find(input('photoable_id'));

        if (!$photoable) {
            return json_response_error('Whoops', 'We could not find the photoable.');
        }

        // move and create the photo
        $photo = $this->moveAndCreatePhoto($attributes['file'], $photoable);

        if (!$photo) {
            return json_response_error('Whoops', 'Something went wrong, please try again.');
        }

        return json_response(['id' => $photo->id]);
    }

    /**
     * Update the photo's name
     * @param Photo $photo
     * @return \Illuminate\Http\JsonResponse
     */
    public function updatePhotoName(Photo $photo)
    {
        $photo->update(['name' => input('name')]);

        return json_response();
    }

    /**
     * Update the album's cover image
     * @param Photo $photo
     * @return \Illuminate\Http\JsonResponse
     */
    public function updatePhotoCover(Photo $photo)
    {
        // get the photoable
        //$photoable = input('photoable_type_name')::find(input('photoable_id'));

        // set all the albums to cover = false
        Photo::where('photoable_id', input('photoable_id'))
            ->where('photoable_type', input('photoable_type'))
            ->update(['is_cover' => false]);

        // update this photo to is_cover
        $photo->update(['is_cover' => true]);

        return json_response();
    }

    /**
     * Remove the specified photo from storage.
     *
     * @param Photo $photo
     * @return Response
     */
    public function destroy(Photo $photo)
    {
        $this->deleteEntry($photo, request());

        log_activity('Photo Deleted', 'A Photo was successfully deleted', $photo);

        return redirect_to_resource();
    }

    /**
     * Save Image in Storage, crop image and save in public/uploads/images
     * @param UploadedFile $file
     * @param              $photoable
     * @param array        $size
     * @return \Illuminate\Http\JsonResponse|static
     */
    private function moveAndCreatePhoto(
        UploadedFile $file,
        $photoable,
        $size = ['l' => [1024, 800], 's' => [250, 195]]
    ) {
        $extension = '.' . $file->extension();

        $name = token();
        $filename = $name . $extension;

        $path = upload_path('photos');
        $imageTmp = Image::make($file->getRealPath());

        if (!$imageTmp) {
            return false;
        }

        if (isset($photoable::$LARGE_SIZE)) {
            $largeSize = $photoable::$LARGE_SIZE;
            $thumbSize = $photoable::$THUMB_SIZE;
        }
        else {
            $largeSize = $size['l'];
            $thumbSize = $size['s'];
        }

        // get file size
        //$bytes = $imageTmp->filesize();
        //if ($bytes && $bytes > 4000000) {
        //    return json_response_error('Sorry', 'The image is to large (max 3MB)');
        //}

        // save original
        $imageTmp->save($path . $name . Photo::$originalAppend . $extension);

        /*// save large
        $imageTmp->fit($largeSize[0], $largeSize[1])->save($path . $filename);

        // save thumbnail from the original image
        $imageTmp->fit($thumbSize[0], $thumbSize[1])
            ->save($path . $name . Photo::$thumbAppend . $extension);*/

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

        $originalName = $file->getClientOriginalName();
        $originalName = substr($originalName, 0, strpos($originalName, $extension));
        $name = strlen($originalName) <= 2 ? $photoable->name : $originalName;
        $photo = Photo::create([
            'filename'       => $filename,
            'photoable_id'   => $photoable->id,
            'photoable_type' => get_class($photoable),
            'name'           => strlen($name) < 2 ? 'Photo Name' : $name,
        ]);

        return $photo;
    }
}
