<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class MenuItem extends Model
{
    //
    protected $table = 'menu_items';

    public function parent()
    {
        return $this->belongsTo('App\Models\MenuItem','parent_id','id');
    }
    public function Menu()
    {
        return $this->belongsTo('App\Models\Menu','menu_id','id');
    }
    
    public function subMenu(){
        return MenuItem::where('parent_id',$this->id)->where('status',1)->orderBy('order','asc')->get();
    }

    public function getNameAttribute()
    {
        $locale = app()->getLocale();
        return $this->{'name_' . $locale};
    }
    public function getLinkAttribute()
    {
        if ($this->type === 'home') {
            return \LaravelLocalization::localizeUrl('/');
        }
        return \LaravelLocalization::localizeUrl($this->type ?? '#');
    }

    protected static function booted()
    {
        static::saved(function () {
            Cache::forget('menus_ar');
            Cache::forget('menus_en');
        });
        static::deleted(function () {
            Cache::forget('menus_ar');
            Cache::forget('menus_en');
        });
    }
}
