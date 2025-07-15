<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Career extends Model
{

    public static function setCurrentLang()
    {

        return app()->getLocale();
    }
    protected $guarded = [];
    protected $table = 'careers';
    
    public function getTitleAttribute()
    {

        return $this->{'title_' . $this->setCurrentLang()};
    }

    public function getTextAttribute()
    {

        return $this->{'text_' . $this->setCurrentLang()};
    }

}
