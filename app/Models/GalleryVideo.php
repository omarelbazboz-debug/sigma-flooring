<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GalleryVideo extends Model
{
    protected $table = 'gallery_videos';

    public static function setCurrentLang()
    {
        return app()->getLocale();
    }
    protected $guarded = [];
    public function getTitleAttribute()
    {
        return $this->{'title_' . $this->setCurrentLang()};
    }
    public function getTextAttribute()
    {
        return $this->{'text_' . $this->setCurrentLang()};
    }
    public function getImageAttribute()
    {
        // Check if the 'image' column has a value
        if ($this->attributes['image']) {
            return asset('uploads/galleryVideo/source/' . $this->attributes['image']);
        }

        // Return a default image if the 'image' column is empty or null
        return asset('assets/back/images/noimage.jpg');
    }
}
