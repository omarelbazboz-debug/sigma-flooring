<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $table='teams';
        protected $guarded = [];

    public static function setCurrentLang()
    {
        return app()->getLocale();
    }
    
        public function getImgAttribute()
    {
        if ($this->attributes['img']) {
            return asset('uploads/teams/source/' . $this->attributes['img']);
        }
        return asset('assets/back/images/noimage.jpg');
    }
    public function getNameAttribute()
    {
        return $this->{'name_' . $this->setCurrentLang()};
    }
    public function getPositionAttribute()
    {
        return $this->{'position_' . $this->setCurrentLang()};
    }
         public function getTextAttribute()
    {
        return $this->{'text_' . $this->setCurrentLang()};
    }      
}
