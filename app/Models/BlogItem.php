<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Illuminate\Support\Facades\Cache;

class BlogItem extends Model
{
    
    public static function setCurrentLang()
    {
        return app()->getLocale();
    }
    protected $guarded = [];
    
    //
    protected $table = 'blogitems';
    protected $fillable=['n_seen'];
    public function Blogcat()
    {
        return $this->belongsTo('App\Models\BlogCategory','blogcategory_id','id');
    }

    public function writers(){
	    return $this->belongsTo('App\Models\Writer','writer_id');
	}
    public function quotes(){
	    return $this->hasMany('App\Models\Faq')->select('question','answer');
    }

    public function getTitleAttribute()
    {

        return $this->{'title_' . $this->setCurrentLang()};
    }
    public function getLinkAttribute()
    {
        return  LaravelLocalization::LocalizeUrl( 'blog/'.$this->{'link_' . $this->setCurrentLang()}); 
    }
    public function getTextAttribute()
    {
        return $this->{'text_' . $this->setCurrentLang()};
    }
    public function getShortTextAttribute()
    {
        return $this->{'shorttext_' . $this->setCurrentLang()};
    }
    public function getImageAttribute()
    {
        // Check if the 'image' column has a value
        if ($this->attributes['image']) {
            return asset('uploads/blogitems/source/' . $this->attributes['image']);
        }

        // Return a default image if the 'image' column is empty or null
        return asset('assets/back/images/noimage.jpg');
    }
    protected static function booted()
    {
        static::saved(function () {
            Cache::forget('blogs_ar');
            Cache::forget('blogs_en');
        });
        static::deleted(function () {
            Cache::forget('blogs_ar');
            Cache::forget('blogs_en');
        });
    }
}
