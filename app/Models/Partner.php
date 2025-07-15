<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use App\ModelsProject;

class Partner extends Model
{
	protected $table='partners';
	protected $guarded = [];

    public static function setCurrentLang()
    {
        return app()->getLocale();
    }

	        public function getLogoAttribute()
    {
        if ($this->attributes['logo']) {
            return asset('uploads/partners/source/' . $this->attributes['logo']);
        }
        return asset('assets/back/images/noimage.jpg');
    }

}
