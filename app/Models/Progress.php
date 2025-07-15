<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Progress extends Model
{

    public static function setCurrentLang()
    {

        return app()->getLocale();
    }

    protected $table = 'progresses';
        protected $guarded = [];


    public function getTitleAttribute()
    {

        return $this->{'title_' . $this->setCurrentLang()};
    }
}
