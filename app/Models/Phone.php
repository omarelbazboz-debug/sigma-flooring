<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Phone extends Model
{
    protected $table = 'phones';
    
 protected $guarded = [];

    public static function setCurrentLang()
    {
        return app()->getLocale();
    }

        public function getTitleAttribute()
    {
        return $this->{'title_' . $this->setCurrentLang()};
    }

}
