<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Illuminate\Support\Facades\Cache;
use App\Helpers\Helper;


class Service extends Model
{
    protected $guarded = [];

    public static function setCurrentLang()
    {
        return app()->getLocale();
    }

    public function images()
    {
        return $this->hasMany(ServiceImage::class, 'service_id');
    }

    public function writer()
    {
        return $this->belongsTo(Writer::class, 'writer_id');
    }

    public function childs()
    {
        return $this->hasMany(Service::class, 'parent_id')->where('status', 1)->orderBy('order', 'asc');
    }

    public function parent()
    {
        return $this->belongsTo(Service::class, 'parent_id') ;
    }
    
    public function albumForService()
    {
        return $this->belongsTo(Service::class, 'album_for');
    }
    
    public function albums()
    {
        return $this->hasMany(Service::class, 'album_for')->where('status', 1)->orderBy('order', 'asc');
    }
    public function haschilds()
    {
        return $this->childs->isNotEmpty();
    }

    public function projects()
    {
        return $this->hasMany(Project::class, 'service_id')->where('status', 1);
    }
        public function features()
    {
        return $this->belongsToMany(Feature::class);
    }

    public function getLinkAttribute()
    {
        $link = '';
        if ($this->haschilds()) {
            $link = Helper::AppUrl('products?parent=' . $this->{'link_' . $this->setCurrentLang()});
        } else {
            $link =  Helper::AppUrl('product/' . $this->{'link_' . $this->setCurrentLang()});
        }
        return $link;
    }

    public function getNameAttribute()
    {
        return $this->{'name_' . $this->setCurrentLang()};
    }

    public function getTextAttribute()
    {
        return $this->{'text_' . $this->setCurrentLang()};
    }

    public function getText1Attribute()
    {
        return $this->{'text1_' . $this->setCurrentLang()};
    }

    public function getImgAttribute()
    {
        if ($this->attributes['img']) {
            return asset('uploads/services/source/' . $this->attributes['img']);
        }
        return asset('public/assets/back/images/noimage.jpg');
    }

    public function getIconAttribute()
    {
        if ($this->attributes['icon']) {
            return asset('uploads/services/source/' . $this->attributes['icon']);
        }
        return asset('public/assets/back/images/noimage.jpg');
    }

    public function getBannerAttribute()
    {
        if ($this->attributes['banner']) {
            return asset('uploads/services/source/' . $this->attributes['banner']);
        }
        return asset('public/assets/back/images/noimage.jpg');
    }

    public function getFileAttribute()
    {
        if ($this->attributes['file']) {
            return asset('uploads/services/pdfs/' . $this->attributes['file']);
        }
        return asset('public/assets/back/images/noimage.jpg');
    }

    protected static function booted()
    {
        static::saved(function () {
            Cache::forget('services_ar');
            Cache::forget('services_en');
        });
        static::deleted(function () {
            Cache::forget('services_ar');
            Cache::forget('services_en');
        });
    }
}
