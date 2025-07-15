<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectAttribute extends Model
{
    protected $table = 'project_attributes';


    public function attribute_name($id){
        return Attribute::where('id',$id)->first();
    }
}
