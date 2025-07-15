<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class About extends Model

{
    protected $table = 'about';
    public static function setCurrentLang()
    {

        return app()->getLocale();
    }
    protected $guarded = [];

    public function getTitleAttribute()
    {

        return $this->{'title_' . $this->setCurrentLang()};
    }
    public function getTitle1Attribute()
    {

        return $this->{'title1_' . $this->setCurrentLang()};
    }
    public function getTextAttribute()
    {

        return $this->{'text_' . $this->setCurrentLang()};
    }
    public function getText1Attribute()
    {

        return $this->{'text1_' . $this->setCurrentLang()};
    }

    public function getImageAttribute()
    {
        // Check if the 'image' column has a value
        if ($this->attributes['image']) {
            return asset('uploads/aboutStrucs/source/' . $this->attributes['image']);
        }

        // Return a default image if the 'image' column is empty or null
        return asset('assets/back/images/noimage.jpg');
    }
    public function getImgAttribute()
    {
        // Check if the 'image' column has a value
        if ($this->attributes['img']) {
            return asset('uploads/aboutStrucs/source/' . $this->attributes['img']);
        }

        // Return a default image if the 'image' column is empty or null
        return asset('assets/back/images/noimage.jpg');
    }
    public function getBannerAttribute()
    {
        // Check if the 'image' column has a value
        if ($this->attributes['banner']) {
            return asset('uploads/aboutStrucs/source/' . $this->attributes['banner']);
        }

        // Return a default image if the 'image' column is empty or null
        return asset('assets/back/images/noimage.jpg');
    }

        public function getLinkAttribute()
    {
        return LaravelLocalization::LocalizeUrl('about-us' . $this->{'link_' . $this->setCurrentLang()});
    }
}
