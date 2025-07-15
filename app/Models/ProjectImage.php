<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use DB;
class ProjectImage extends Model
{
	protected $table='project_images';

    public $timestamps =false;

    public function getImageUrlAttribute()
    {
        return $this->image 
            ? asset('uploads/projects/source/' . $this->image) 
            : asset('assets/back/images/noimage.jpg'); // صورة افتراضية إذا لم تكن الصورة موجودة
    }
}
