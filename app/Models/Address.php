<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $table = 'addresses';
    public static function setCurrentLang()
    {

        return app()->getLocale();
    }
    protected $guarded = [];

    public function getAddressAttribute()
    {

        return $this->{'address_' . $this->setCurrentLang()};
    }
    public function getTitleAttribute()
    {

        return $this->{'title_' . $this->setCurrentLang()};
    }
    
}
