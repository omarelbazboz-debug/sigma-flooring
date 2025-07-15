<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{
    protected $fillable = ['name_en', 'name_ar'];

    protected $guarded = [];

    public static function setCurrentLang()
    {
        return app()->getLocale();
    }

    public function projects()
    {
        return $this->belongsToMany(Project::class);
    }
        public function services()
    {
        return $this->belongsToMany(Service::class);
    }

        public function getNameAttribute()
    {
        return $this->{'name_' . $this->setCurrentLang()};
    }
}
