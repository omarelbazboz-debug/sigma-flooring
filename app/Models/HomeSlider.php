<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use Illuminate\Support\Facades\Cache;


class HomeSlider extends Model
{
	protected $table = 'home_sliders';
	protected $guarded = [];

	public static function setCurrentLang()
	{
		return app()->getLocale();
	}
	public function getImageAttribute()
    {
        if ($this->attributes['image']) {
            return asset('uploads/sliders/home-sliders/source/' . $this->attributes['image']);
        }
        return asset('assets/back/images/noimage.jpg');
    }

    protected static function booted()
    {
        static::saved(function ($slider) {
            Cache::forget('sliders_ar');
            Cache::forget('sliders_en');
        });
        static::deleted(function ($slider) {
            Cache::forget('sliders_ar');
            Cache::forget('sliders_en');
        });
    }
}
