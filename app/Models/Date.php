<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Date extends Model
{

    public static function setCurrentLang()
    {

        return app()->getLocale();
    }
    protected $table = 'dates';
    
    protected $guarded = [];
    public function getTitleAttribute()
    {

        return $this->{'title_' . $this->setCurrentLang()};
    }

    public function getTitle1Attribute()
    {

        return $this->{'title1_' . $this->setCurrentLang()};
    }



}
