<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoriesResourse;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
   public function categories(){
    $categories=Category::all();
    $data=CategoriesResourse::collection( $categories );
    // dd($categories);
     return $this->success(data: $data);
   }
}
