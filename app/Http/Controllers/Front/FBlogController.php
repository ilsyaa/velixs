<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Helpers\Metavis;
use App\Models\Blog;
use App\Models\BlogView;
use Illuminate\Http\Request;

class FBlogController extends Controller
{
    public function index(Request $request)
    {
        $type = $request->route()->getName() == 'front.article.index' ? 'article' : 'tutorial';
        $blogs = Blog::whereNotNull('published_at');
        $blogs->withCount('comments as comment_count');
        $blogs->where('content_type', $type);
        if ($request->search) {
            $blogs->where('title', 'LIKE', '%' . $request->search . '%');
        }
        if ($request->tags) {
            $blogs->whereHas('tags', function ($query) use ($request) {
                $query->where('slug', $request->tags);
            });
        }
        if ($request->category) {
            $blogs->whereHas('category', function ($query) use ($request) {
                $query->where('slug', $request->category);
            });
        }
        $blogs->latest();
        $blogs = $blogs->paginate(config('app.blog_page'));

        if ($type == 'article') {
            $meta = [
                'meta_title' => 'Articles - %title%',
                'meta_description' => 'Jika Anda kekurangan waktu, dan ingin memanfaatkannya sebaik mungkin, kami telah menyediakan beberapa artikel yang mungkin berguna bagi Anda.',
            ];
        } else {
            $meta = $this->meta_tutorial($request);
            if (!$meta) return Metavis::abort('404', 'Topic not found');
        }
        return Metavis::view('blogs.index', [
            'blogs' => $blogs,
            'main_blog' => $blogs->first(),
            'content_type' => $type,
            'req_category' => $request->category,
            'categories' => Category::where('type', 'blog')->get(),
            'meta' => $meta
        ]);
    }

    function meta_tutorial($request)
    {
        if ($request->category) {
            switch ($request->category) {
                case "html":
                    return [
                        'title' => 'Belajar HTML.',
                        'meta_title' => 'HTML - %title%',
                        'meta_description' => 'HTML5 is a markup language used for structuring and presenting content on the World Wide Web.',
                    ];
                    break;
                case "php":
                    return [
                        'title' => 'Belajar PHP.',
                        'meta_title' => 'PHP - %title%',
                        'meta_description' => 'A popular general-purpose scripting language that is especially suited to web development. Fast, flexible and pragmatic, PHP powers everything from your blog to the most popular websites in the world.',
                    ];
                    break;
                case "laravel":
                    return [
                        'title' => 'Belajar Laravel.',
                        'meta_title' => 'Laravel - %title%',
                        'meta_description' => 'Laravel is a web application framework with expressive, elegant syntax. It has already laid the foundation, freeing you to create without sweating the small things.',
                    ];
                    break;
                case "bootstrap":
                    return [
                        'title' => 'Belajar Bootstrap.',
                        'meta_title' => 'Bootstrap - %title%',
                        'meta_description' => 'Powerful, extensible, and feature-packed frontend toolkit. Build and customize with Sass, utilize prebuilt grid system and components, and bring projects to life with powerful JavaScript plugins.',
                    ];
                    break;
                case "js":
                    return [
                        'title' => 'Belajar JavaScript.',
                        'meta_title' => 'JavaScript - %title%',
                        'meta_description' => 'Programming language that is one of the core technologies of the World Wide Web, alongside HTML and CSS.',
                    ];
                    break;
                case "js":
                    return [
                        'title' => 'Belajar JavaScript.',
                        'meta_title' => 'JavaScript - %title%',
                        'meta_description' => 'Programming language that is one of the core technologies of the World Wide Web, alongside HTML and CSS.',
                    ];
                    break;
                default:
                    return;
            }
        } else {
            return [
                'meta_title' => 'Tutorial - %title%',
                'meta_description' => 'Belajar pemrograman web, web design & mobile app lengkap dari dasar untuk pemula sampai mahir, tersedia tutorial dengan studi kasus.',
            ];
        }
    }

    public function detail(Blog $blog)
    {
        if ($blog->content_type != (request()->route()->getName() == 'front.article.detail' ? 'article' : 'tutorial'))
            return Metavis::abort('LOL', 'Page not found', ['title' => 'Back Home', 'url' => route('index')]);
        BlogView::record($blog);
        return Metavis::view('blogs.detail', [
            'blog' => $blog,
            'meta' => [
                'meta_title' => $blog->title,
                'meta_description' => $blog->meta_description,
                'meta_image' => $blog->_thumbnail(),
                'meta_type' => 'article'
            ]
        ]);
    }
}
