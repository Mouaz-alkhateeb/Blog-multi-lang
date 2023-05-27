<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;

class WebsiteCategoryController extends Controller
{
    public function show(Category $category)
    {
        $category = $category->load('child');
        $posts = Post::where('category_id', $category->id)->paginate(5);

        return view('website.category', compact('category', 'posts'));
    }
}
