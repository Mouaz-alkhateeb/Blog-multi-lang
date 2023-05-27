<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Post;

class WebsitePostController extends Controller
{
    public function show(Post $post)
    {
        return view('website.post', compact('post'));
    }
}
