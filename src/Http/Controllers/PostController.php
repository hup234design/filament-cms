<?php

namespace Hup234design\FilamentCms\Http\Controllers;

use App\Http\Controllers\Controller;
//use Hup234design\FilamentCms\Models\IndexPage;
use Hup234design\FilamentCms\Models\IndexPage;
use Hup234design\FilamentCms\Models\Post;
use Hup234design\FilamentCms\Models\PostCategory;

class PostController extends Controller
{
    public function index()
    {
        $page = IndexPage::where('slug', 'posts')->firstOrFail();
        $posts = Post::with('post_category')->visible()->paginate(3);
        return view('posts.index', compact('page', 'posts'));
    }

    public function post($slug)
    {
        $post = Post::whereSlug($slug)->firstOrFail();
        return view('posts.post', compact('post'));
    }

    public function category($slug)
    {
        $category = PostCategory::whereSlug($slug)->firstOrFail();
        $posts = $category->posts()->with('post_category')->visible()->paginate(3);
        return view('posts.category', compact('category','posts'));
    }
}
