<?php

namespace App\Models;
use App\Models\Project;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';

    public function subCategories(){
        return $this->hasMany(Category::class, 'parent_id', 'id');
    }

    public function projects(){
        return $this->hasMany(Project::class, 'category_id', 'id')->where('status', 1);
    }

    public function getProducts(){
        return Project::where('category_id', $this->id)->where('status', 1)->get();
    }

    public function projectsCount(){
        return $this->projects()->count();
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }
}