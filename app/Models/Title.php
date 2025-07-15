<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Title extends Model
{
    public static function setCurrentLang()
    {

        return app()->getLocale();
    }
    protected $table = 'titles';

    protected $guarded = [];

    public static function getSectionsTypesSelect()
    {
        return [
            'slider'   => __('home.slider'),
            'progresses'   => __('home.progresses'),
            'testimonial' => __('home.testimonials'),
            'partner' => __('home.partners'),
            'services' => __('home.services'),
            'gallery' => __('home.gallery'),
            'header' => __('home.header'),
            'teams' => __('home.teams'),
            'about' => __('home.about'),
            'contact' => __('home.contact'),
            'careers' => __('home.careers'),
            'projects' => __('home.projects'),
            'reviews' => __('home.reviews'),
            'whyus' => __('home.whyus'),
            'skills' => __('home.skills'),
            'vedios' => __('home.vedios'),
            'aboutStruc' => __('home.aboutStruc'),
            'footer' => __('home.footer'),
            'date' => __('home.date'),
            'blogs' => __('home.blogs'),
            'brand' => __('home.brand'),
            'news' => __('home.news'),
            'catalogue' => __('home.catalogue'),
            'album' => __('home.album'),
            'philosophy' => __('home.philosophy'),
        ];
    }


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

    public function getImageAttribute()
    {
        if ($this->attributes['image']) {
            return asset('uploads/titles/source/' . $this->attributes['image']);
        }
        return asset('assets/back/images/noimage.jpg');
    }

    public static function Section($type)
    {
        return Self::where('type', $type)->first();
    }
}
