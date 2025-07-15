<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    protected $guarded = [];

    public static function setCurrentLang()
    {
        return app()->getLocale();
    }
    
        public function getImgAttribute()
    {
        if ($this->attributes['img']) {
            return asset('uploads/testimonials/source/' . $this->attributes['img']);
        }
        return asset('assets/back/images/noimage.jpg');
    }
}
