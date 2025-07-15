<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GalleryImage extends Model
{

    protected $guarded = [];
    protected static $defaultImage = 'resources/assets/back/images/noimage.jpg';

    protected $table = 'gallery_images';


    protected function getFilePath($attribute, $path)
    {
        return !empty($this->attributes[$attribute])
            ? url($path . $this->attributes[$attribute])
            : url(self::$defaultImage);
    }

    public function getImgAttribute()
    {
        return $this->getFilePath('img', 'uploads/galleryImages/source/');
    }

}
