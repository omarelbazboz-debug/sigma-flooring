<?php

namespace App\Models;

use App\Helpers\Helper;
use Illuminate\Database\Eloquent\Model;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Models\AlbumItem;
use Illuminate\Support\Facades\Cache;

class Album extends Model
{
    protected $table = 'album';
    protected $guarded = ['id', 'created_at', 'updated_at' ,'image' ,'link_en', 'link_ar'];

    public static function setCurrentLang()
    {
        return app()->getLocale();
    }

    public function images(){
        return $this->hasMany(AlbumItem::class,'album_id');
    }

    public function firstImage(){
        return AlbumItem::where('album_id',$this->id)->first();
    }
    public function getNameAttribute()
    {
        return $this->{'name_' . $this->setCurrentLang()};
    }
    public function getLinkAttribute()
    {
        return Helper::AppUrl('service/'.$this->{'link_'. $this->setCurrentLang()});
    }


        public function getImageAttribute()
            {
                if ($this->attributes['image']) {
                    return asset('uploads/album_items/source/' . $this->attributes['image']);
                }
                return asset('assets/back/images/noimage.jpg');
            }


}
