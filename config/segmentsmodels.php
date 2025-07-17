<?php

use App\Models\Album;
use App\Models\BlogItem;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Project;
use App\Models\Service;

return[
   'segments' => [
        'blog' =>  BlogItem::class,
        'service' =>  Album::class,
        'product' =>   Service::class,
        'project' =>   Project::class,
        'category' => Category::class ,
        'brand' =>  Brand::class,
        ]
];
