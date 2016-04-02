<?php

namespace Titan\Controllers\Traits;

use Image;
use Notify;

trait UploadFile
{
    /**
     * Upload the profile picture image
     *
     * @param        $file
     * @return string|void
     */
    public function uploadProfilePicture($file)
    {
        $name = token();
        $extension = $file->guessClientExtension();

        $filename = $name . '.' . $extension;
        $imageTmp = Image::make($file->getRealPath());

        if (!$imageTmp) {
            return Notify::error('Oops', 'Something went wrong', 'warning shake animated');
        }

        $path = upload_path_images();

        // save the image
        $image = $imageTmp->fit(160, 160)->save($path . $filename);

        return $filename;
    }

    /**
     * Upload the banner image, create a thumb as well
     *
     * @param        $file
     * @param string $path
     * @param array  $size
     * @return string|void
     */
    public function uploadBanner($file, $path = '', $size = ['o' => [1900, 550], 'tn' => [450, 212]])
    {
        $name = token();
        $extension = $file->guessClientExtension();

        $filename = $name . '.' . $extension;
        $filenameThumb = $name . '-tn.' . $extension;
        $imageTmp = Image::make($file->getRealPath());

        if (!$imageTmp) {
            return Notify::error('Oops', 'Something went wrong', 'warning shake animated');
        }

        $path = upload_path_images($path);

        // save the image
        $image = $imageTmp->fit($size['o'][0], $size['o'][1])->save($path . $filename);

        $image->fit($size['tn'][0], $size['tn'][1])->save($path . $filenameThumb);

        return $filename;
    }

    /**
     * Save Image in Storage, crop image and save in public/uploads/images
     *
     * @param        $file
     * @param string $path
     * @param array  $size
     * @return array|void
     */
    public function uploadPhoto($file, $path = '', $size = ['o' => [745, 480], 'tn' => [373, 240]])
    {
        $name = token();
        $extension = $file->guessClientExtension();

        $filename = $name . '.' . $extension;
        $filenameThumb = $name . '-tn.' . $extension;

        $path = upload_path('images' . DIRECTORY_SEPARATOR . $path) . DIRECTORY_SEPARATOR;

        $imageTmp = Image::make($file->getRealPath());

        if (!$imageTmp) {
            return Notify::error('Oops', 'Something went wrong', 'warning shake animated');
        }

        // save the image
        $image = $imageTmp->fit($size['o'][0], $size['o'][1])->save($path . $filename);

        $image->fit($size['tn'][0], $size['tn'][1])->save($path . $filenameThumb);

        return ['image' => $filename, 'thumb' => $filenameThumb];
    }

    /**
     * Move the tmp file to desired location
     * @param        $file
     * @param string $path
     * @return string|void
     */
    public function moveFile($file, $path = '')
    {
        $name = token();
        $extension = $file->guessClientExtension();

        $filename = $name . '.' . $extension;
        $imageTmp = Image::make($file->getRealPath());

        if (!$imageTmp) {
            return Notify::error('Oops', 'Something went wrong', 'warning shake animated');
        }

        $path = upload_path_images($path);
        $image = $imageTmp->save($path . $filename);

        return $filename;
    }
}