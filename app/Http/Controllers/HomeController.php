<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Page;
use App\Models\Category;
use App\Models\BlogComment;
use Illuminate\Http\Request;
use App\Models\BlogCommentReply;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function home()
    {
        $getPage = Page::getSlug('home');
        $data['meta_title'] = !empty($getPage) ? $getPage->meta_title : '';
        $data['meta_description'] = !empty($getPage) ? $getPage->meta_description : '';
        $data['meta_keywords'] = !empty($getPage) ? $getPage->meta_keywords : '';
        return view('home', $data);
    }

    public function about()
    {
        return view('about');
    }
    public function courses()
    {
        return view('courses');
    }

    public function blog()
    {
        $data['getRecordTitle'] = Blog::getRecordFront();
        $data['getRecord_b'] = Blog::getRecordFront();
        $data['header_title'] = 'Blog';
        return view('blog', $data);
    }

    public function contact()
    {
        $getPage = Page::getSlug('contact');
        $data['meta_title'] = !empty($getPage) ? $getPage->meta_title : '';
        $data['meta_description'] = !empty($getPage) ? $getPage->meta_description : '';
        $data['meta_keywords'] = !empty($getPage) ? $getPage->meta_keywords : '';
        return view('contact', $data);
    }

    public function blogdetail($slug)
    {
        $getCategory = Category::getSlug($slug);
        if(!empty($getCategory))
        {
            $data['meta_title'] = $getCategory->meta_title;
            $data['meta_description'] = $getCategory->meta_description;
            $data['meta_keywords'] = $getCategory->meta_keywords;
            $data['header_title'] = $getCategory->title;
            $data['getRecord_b'] = Blog::getRecordFrontCategory($getCategory->id);
            return view('blog', $data);
        }
        else
        {
            $getRecord = Blog::getRecordSlug($slug);
            if(!empty($getRecord))
            {
                $data['getCategory'] = Category::getCategory();
                $data['getRelatedPost'] = Blog::getRelatedPost($getRecord->category_id,$getRecord->id);
                $data['getRecentPost'] = Blog::getRecentPost();
                $data['getRecord'] = $getRecord;

                $data['meta_title'] = $getRecord->title;
                $data['meta_description'] = $getRecord->meta_description;
                $data['meta_keywords'] = $getRecord->meta_keywords;

                return view('blog_detail', $data);
            }
            else
            {
                abort(404);
            }
        }

    }

    public function BlogCommentSubmit(Request $request)
    {
        $comment = new BlogComment;
        $comment->user_id = Auth::user()->id;
        $comment->blog_id = $request->blog_id;
        $comment->comment = $request->comment;
        $comment->save();

        return redirect()->back()->with('success', "Your comment is Successful");
    }

    public function BlogCommentReplySubmit(Request $request)
    {
        $reply = new BlogCommentReply;
        $reply->user_id = Auth::user()->id;
        $reply->comment_id = $request->comment_id;
        $reply->comment = $request->comment;
        $reply->save();

        return redirect()->back()->with('success', "Your reply is Successful");
    }
}