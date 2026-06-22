<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class Project extends Model
{
    protected $guarded = [];
    protected static $defaultImage = 'public/assets/back/images/noimage.jpg';
    protected $currentLang;

    public static function setCurrentLang()
    {
        return app()->getLocale();
    }

    public function getCurrentLang()
    {
        if (!$this->currentLang) {
            $this->currentLang = app()->getLocale();
        }
        return $this->currentLang;
    }

    protected $table = 'projects';

    public function images()
    {
        return $this->hasMany(ProjectImage::class, 'project_id');
    }

public function features()
{
    return $this->belongsToMany(Feature::class);
}


    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id');
    }

    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    public function attributes()
    {
        return $this->hasMany(ProjectAttribute::class, 'project_id');
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function getLinkAttribute()
    {
        $link = $this->{'link_' . $this->getCurrentLang()} ?? '';
        return LaravelLocalization::LocalizeUrl('project/' . $link);
    }

    public function getNameAttribute()
    {
        return $this->{'name_' . $this->getCurrentLang()} ?? '';
    }

    public function getTextAttribute()
    {
        return $this->{'text_' . $this->getCurrentLang()} ?? '';
    }

    public function getText1Attribute()
    {
        return $this->{'text1_' . $this->getCurrentLang()};
    }
    public function getText2Attribute()
    {
        return $this->{'text2_' . $this->getCurrentLang()};
    }

    protected function getFilePath($attribute, $path)
    {
        return isset($this->attributes[$attribute]) && $this->attributes[$attribute]
            ? url($path . $this->attributes[$attribute])
            : url(self::$defaultImage);
    }

    public function getImageAttribute()
    {
        if ($this->attributes['image']) {
            return asset('uploads/projects/source/' . $this->attributes['image']);
        }
        return asset('public/assets/back/images/noimage.jpg');
    }
    public function getImgAttribute()
    {
        if ($this->attributes['img']) {
            return asset('uploads/projects/source/' . $this->attributes['img']);
        }
        return asset('public/assets/back/images/noimage.jpg');
    }
    public function getPhotoAttribute()
    {
        if ($this->attributes['photo']) {
            return asset('uploads/projects/source/' . $this->attributes['photo']);
        }
        return asset('public/assets/back/images/noimage.jpg');
    }
    public function getBannerAttribute()
    {
        if ($this->attributes['banner']) {
            return asset('uploads/projects/source/' . $this->attributes['banner']);
        }
        return asset('public/assets/back/images/noimage.jpg');
    }

    public function getFileAttribute()
    {
        return $this->getFilePath('file', 'uploads/projects/source/');
    }
}
