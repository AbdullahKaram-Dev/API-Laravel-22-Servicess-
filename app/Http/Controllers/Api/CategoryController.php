<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;

class CategoryController extends Controller
{
    public function categories(){

        $categories = Category::all();

        if ($categories){

            return apiResponse(1,'success',$categories);
        }else{


            return apiResponse(0,'filed',$categories);
        }

    }
}
