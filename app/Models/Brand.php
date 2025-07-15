<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use App\ModelsProject;

class Brand extends Model
{
	protected $table='brands';
	protected $guarded = [];

    public static function setCurrentLang()
    {
        return app()->getLocale();
    }

    public function projectsCount(){
        return Project::where('brand_id',$this->id)->where('status',1)->count();
    }

        public function getLogoAttribute()
    {
        if ($this->attributes['logo']) {
            return asset('uploads/brands/source/' . $this->attributes['logo']);
        }
        return asset('assets/back/images/noimage.jpg');
    }

}
