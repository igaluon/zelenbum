<?php

namespace app\imageresize;

use Imagine\Image\Box;
use Imagine\Image\Point;
use yii\imagine\Image;

class ImageResize
{
    static  function imageresize($image, $new_name, $new_width, $new_heigth)
    {
        $size = getimagesize($image);
        $width = $size[0];
        $height = $size[1];

        Image::frame($image, 0, '666', 0)
            ->crop(new Point(0, 0), new Box($width, $height))
            ->resize(new Box($new_width, $new_heigth))
            ->save($new_name, ['quality' => 100]);
    }
}