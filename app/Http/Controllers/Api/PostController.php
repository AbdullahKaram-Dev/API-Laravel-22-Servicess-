<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;


class PostController extends Controller
{
    public function posts()
    {
        $posts = Post::all();

        return apiResponse(1, 'success', $posts);

    }

    public function AllPostsWithCategory(){

        $PostCategory = Post::with('category')->get();

        return apiResponse(1,'Success To Get Posts With Category',$PostCategory);

    }

    public function SinglePost($id){

        $singlePost = Post::with('category')->findOrFail($id);

        return apiResponse(1,'Success To Get Single Post',$singlePost);

    }
}
