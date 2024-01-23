<?php

namespace Hup234design\FilamentCms\Http\Controllers;

use App\Http\Controllers\Controller;
//use Hup234design\FilamentCms\Models\IndexPage;
use Hup234design\FilamentCms\Models\Post;
use Hup234design\FilamentCms\Models\PostCategory;

class PostController extends Controller
{
    public function index()
    {
        //$page = IndexPage::where('for', 'posts')->firstOrFail();

        $posts = Post::with('post_category')->visible()->paginate(3);

        //return view('cms::posts.index', compact('page', 'posts'));
        return view('cms::posts.index', compact('posts'));
    }

    public function post($slug)
    {
        $post = Post::whereSlug($slug)->firstOrFail();
        return view('cms::posts.post', compact('post'));
    }

    public function category($slug)
    {
        $category = PostCategory::whereSlug($slug)->firstOrFail();

        $posts = $category->posts()->with('post_category')->visible()->paginate(3);

        return view('cms::posts.category', compact('category','posts'));
    }
}
