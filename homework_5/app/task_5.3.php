<?php
use Intervention\Image\ImageManagerStatic as IImage;

require '../vendor/autoload.php';

$img = IImage::make(__DIR__ . '/img/1.jpg');
$img
    ->resize(200, null, function($image) {
        $image->aspectRatio();
    })
    ->text(
        "Пряня!",
        $img->width() / 2,
        $img->height() / 2,
        function($font) {
            $font->file('HelveticaRegular.ttf');
            $font->color([32, 32, 32, .6]);
            $font->align('center');
            $font->valign('center');
        }
    )
    ->save('img/1-new.jpg');