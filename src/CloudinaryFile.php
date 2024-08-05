<?php

namespace Cloudinary\Upload;

use Cloudinary\Configuration\Configuration;
use Cloudinary\Api\Upload\UploadApi;
use Cloudinary\Api\Admin\AdminApi;
use Cloudinary\Transformation\Resize;
use Cloudinary\Transformation\Background;
use Cloudinary\Tag\ImageTag;


class CloudinaryFile
{
    public static function getCloudinaryUrl()
    {
        $appName = config('cloudenary.CLOUDNARY_APP_NAME');
        $apiKey = config('cloudenary.CLOUDNARY_API_KEY');
        $apiSecret = config('cloudenary.CLOUDNARY_API_SECRET');
        $CLOUDINARY_URL = 'cloudinary://' . $apiKey . ':' . $apiSecret . '@' . $appName . '?secure=true';
        return Configuration::instance($CLOUDINARY_URL);
    }


    public static function getFile($public_id)
    {
        self::getCloudinaryUrl();
        $file = new AdminApi();
        $data = $file->asset($public_id, [
            'colors' => true
        ]);
        return json_decode(json_encode($data));
    }

    public static function uploadFile($path)
    {
        $upload = new UploadApi();
        $data = $upload->upload($path, [
            'public_id' => 'flower_sample',
            'use_filename' => true,
            'overwrite' => true
        ]);
        return json_decode(json_encode($data));
    }
    public static function viewFile($public_id)
    {
        $data = (new ImageTag($public_id, $width = 500, $height = 500))
            ->resize(
                Resize::pad()
                    ->width($width)
                    ->height($height)
                    ->background(Background::predominant())
            );
        return json_decode(json_encode($data));
    }
}
