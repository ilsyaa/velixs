<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogComment;
use App\Models\ProductComment;
use Illuminate\Http\Request;
use App\Helpers\Metavis;

class CommentsController extends Controller
{
    public function index($url)
    {
        if ($url == 'products') {
            return Metavis::lyna('admin.comments.index', [
                'title' => 'Product Comments',
                'comments_products_active' => true,
                'type' => 'products',
            ]);
        } else {
            return Metavis::lyna('admin.comments.index', [
                'title' => 'Blog Comments',
                'comments_blogs_active' => true,
                'type' => 'blogs',
            ]);
        }
    }

    public function show($url)
    {
        if ($url == 'products') {
            return view('admin.comments.edit', [
                'type' => 'products',
                'item' => ProductComment::find(request()->id),
            ]);
        } else {
            return view('admin.comments.edit', [
                'type' => 'products',
                'item' => BlogComment::find(request()->id),
            ]);
        }
    }

    public function acc($url)
    {
        if ($url == 'products') {
            $comment = ProductComment::find(request()->id);
            $comment->status = 'approved';
            $comment->save();
            return true;
        } else {
            $comment = BlogComment::find(request()->id);
            $comment->status = 'approved';
            $comment->save();
            return true;
        }
    }

    public function json()
    {
        if (request()->type == 'products') {
            $comments = ProductComment::orderBy('status', 'desc')->get();
        } else {
            $comments = BlogComment::orderBy('status', 'desc')->get();
        }
        return datatables()->of($comments)
            ->addColumn('action', function ($comment) {
                return '<a href="javascript:void(0)" onclick="detail(' . $comment->id . ')" data-bs-toggle="modal" data-bs-target="#detail" class="item-edit"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-list"><line x1="8" y1="6" x2="21" y2="6"></line><line x1="8" y1="12" x2="21" y2="12"></line><line x1="8" y1="18" x2="21" y2="18"></line><line x1="3" y1="6" x2="3.01" y2="6"></line><line x1="3" y1="12" x2="3.01" y2="12"></line><line x1="3" y1="18" x2="3.01" y2="18"></line></svg></a>';
            })->addColumn('responsive_id', function () {
                return '';
            })->addColumn('type', function ($comment) {
                return $comment->parent_id == null ? 'Comment' : 'Reply';
            })->addColumn('item', function ($comment) {
                if (request()->type == 'products') {
                    return $comment->product->name;
                } else {
                    return $comment->blog->title;
                }
            })->editColumn('status', function ($comment) {
                return $comment->status == "approved" ? '<span class="badge bg-light-success">Approved</span>' : '<span class="badge bg-light-warning">Pending</span>';
            })->editColumn('created_at', function ($comment) {
                return $comment->created_at->format('d M Y (H:i)');
            })
            ->rawColumns(['action', 'status'])
            ->toJson();
    }

    public function destroyall(Request $request, $url)
    {
        $ids = $request->id;
        if ($url == "products") {
            ProductComment::whereIn('id', $ids)->delete();
        } else {
            BlogComment::whereIn('id',  $ids)->delete();
        }
        return response()->json(['status' => true, 'message' => 'Comment deleted successfully.']);
    }
}
