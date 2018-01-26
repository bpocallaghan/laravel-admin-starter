<?php

namespace App\Http\Controllers\Admin\Photos;

use Image;
use App\Models\Banner;
use App\Http\Requests;
use App\Http\Controllers\Admin\AdminController;

class CropResourceController extends AdminController
{
    private $LARGE_SIZE = [800, 800];

    private $THUMB_SIZE = [400, 400];

    /**
     * @param       $photoable
     * @return this
     */
    private function showCropper($photoable)
    {
        return $this->view('photos.crop_resource')->with('photoable', $photoable);
    }

    /**
     * @param Banner $banner
     * @return this
     */
    public function showBanner(Banner $banner)
    {
        return $this->showCropper($banner);
    }

    /**
     * Crop a photo
     * @return \Illuminate\Http\JsonResponse
     */
    public function cropPhoto()
    {
        $photoable = input('photoable_type')::find(input('photoable_id'));

        // if relationship not found
        if (!$photoable) {
            return json_response_error('Whoops', 'We could not find the photoable.');
        }

        // get the large and thumb sizes
        if (isset($photoable::$LARGE_SIZE)) {
            $largeSize = $photoable::$LARGE_SIZE;
            $thumbSize = $photoable::$THUMB_SIZE;
        }
        else {
            $largeSize = $this->LARGE_SIZE;
            $thumbSize = $this->THUMB_SIZE;
        }

        // open file image resource
        $path = upload_path('images');
        $originalImage = Image::make($photoable->original_url);

        // get the crop data
        $x = intval(input('x'));
        $y = intval(input('y'));
        $width = intval(input('width'));
        $height = intval(input('height'));

        // crop image on cropped area
        $imageTmp = $originalImage->crop($width, $height, $x, $y);

        // resize the image to large size
        $imageTmp->resize($largeSize[0], null, function ($constraint) {
            $constraint->aspectRatio();
        })->save($path . $photoable->image);

        // resize the image to thumb size
        $imageTmp->resize($thumbSize[0], null, function ($constraint) {
            $constraint->aspectRatio();
        })->save($path . $photoable->image_thumb);

        return json_response('success');
    }
}