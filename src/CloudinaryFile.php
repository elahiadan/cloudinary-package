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

    public function __construct()
    {
        $appName = config('CLOUDNARY_APP_NAME');
        $apiKey = config('CLOUDNARY_API_KEY');
        $apiSecret = config('CLOUDNARY_API_SECRET');
        // $CLOUDINARY_URL = 'cloudinary://' . $apiKey . ':' . $apiSecret . '@' . $appName . '?secure=true';
        // $CLOUDINARY_URL = "cloudinary://$apiKey:$apiSecret@$appName?secure=true";
        // Configuration::instance($CLOUDINARY_URL);

        $CLOUDINARY_URL= 'cloudinary://771339168539911:uOydaRpM8YiArBdH9KgqH3C0Qi0@dsty6w1es?secure=true';
        Configuration::instance($CLOUDINARY_URL);
    }
    public static function getFile($public_id)
    {
        $file = new AdminApi();
        $data = $file->asset($public_id, [
            'colors' => true
        ]);
        return $data;
    }

    public static function uploadFile($path)
    {
        $upload = new UploadApi();
        $data = $upload->upload($path, [
            'public_id' => 'flower_sample',
            'use_filename' => true,
            'overwrite' => true
        ]);
        return $data;
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

        return $data;
    }
}
