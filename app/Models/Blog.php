<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Blog extends Model
{
    use HasFactory;

    protected $table = 'blogs';

    static public function getSingle($id)
    {
        return self::find($id);
    }

    static public function getRecordSlug($slug)
    {
        return self::select('blogs.*', 'users.name as user_name', 'categories.name as category_name','categories.slug as category_slug')
                 ->join('users', 'users.id', '=', 'blogs.user_id')
                 ->join('categories', 'categories.id', '=', 'blogs.category_id')
                 ->where('blogs.status', '=', 1)
                 ->where('blogs.is_delete', '=', 0)
                 ->where('blogs.is_publish', '=', 1)
                 ->where('blogs.slug', '=', $slug)
                 ->first();
    }

    static public function getRecordFront()
    {
        $return = self::select('blogs.*', 'users.name as user_name', 'categories.name as category_name','categories.slug as category_slug')
                 ->join('users', 'users.id', '=', 'blogs.user_id')
                 ->join('categories', 'categories.id', '=', 'blogs.category_id');
                 if(!empty(Request::get('q')))
                 {
                    $return = $return->where('blogs.title', 'like', '%'.Request::get('q').'%');
                 }
        $return = $return->where('blogs.status', '=', 1)
                 ->where('blogs.is_delete', '=', 0)
                 ->where('blogs.is_publish', '=', 1)
                 ->orderBy('blogs.id', 'desc')
                 ->paginate(10);

        return $return;
    }
    static public function getRecordFrontCategory($category_id)
    {
        $return = self::select('blogs.*', 'users.name as user_name', 'categories.name as category_name','categories.slug as category_slug')
                 ->join('users', 'users.id', '=', 'blogs.user_id')
                 ->join('categories', 'categories.id', '=', 'blogs.category_id')
                 ->where('blogs.category_id', '=', $category_id)
                 ->where('blogs.status', '=', 1)
                 ->where('blogs.is_delete', '=', 0)
                 ->where('blogs.is_publish', '=', 1)
                 ->orderBy('blogs.id', 'desc')
                 ->paginate(10);

        return $return;
    }

    static public function getRecentPost()
    {
        return self::select('blogs.*', 'users.name as user_name', 'categories.name as category_name','categories.slug as category_slug')
                 ->join('users', 'users.id', '=', 'blogs.user_id')
                 ->join('categories', 'categories.id', '=', 'blogs.category_id')
                 ->where('blogs.status', '=', 1)
                 ->where('blogs.is_delete', '=', 0)
                 ->where('blogs.is_publish', '=', 1)
                 ->orderBy('blogs.id', 'desc')
                 ->limit(10)
                 ->get();
    }

    static public function getRelatedPost($category_id,$id)
    {
        return self::select('blogs.*', 'users.name as user_name', 'categories.name as category_name','categories.slug as category_slug')
                 ->join('users', 'users.id', '=', 'blogs.user_id')
                 ->join('categories', 'categories.id', '=', 'blogs.category_id')
                 ->where('blogs.id', '!=', $id)
                 ->where('blogs.category_id', '=', $category_id)
                 ->where('blogs.status', '=', 1)
                 ->where('blogs.is_delete', '=', 0)
                 ->where('blogs.is_publish', '=', 1)
                 ->orderBy('blogs.id', 'desc')
                 ->limit(3)
                 ->get();
    }

    static public function getRecord()
    {
        $return = self::select('blogs.*', 'users.name as user_name', 'categories.name as category_name','categories.slug as category_slug','users.id as user_id')
                 ->join('users', 'users.id', '=', 'blogs.user_id')
                 ->join('categories', 'categories.id', '=', 'blogs.category_id');
                 if(!empty(Auth::check()) && Auth::user()->is_admin != 1)
                 {
                    $return = $return->where('blogs.user_id', '=', Auth::user()->id);
                 }
                 if(!empty(Request::get('id')))
                 {
                    $return = $return->where('blogs.id', '=', Request::get('id'));
                 }
                 if(!empty(Request::get('username')))
                 {
                    $return = $return->where('users.name', 'like', '%'.Request::get('username').'%');
                 }
                 if(!empty(Request::get('title')))
                 {
                    $return = $return->where('blogs.title', 'like', '%'.Request::get('title').'%');
                 }
                 if(!empty(Request::get('category')))
                 {
                    $return = $return->where('categories.name', 'like', '%'.Request::get('category').'%');
                 }
                 if(!empty(Request::get('is_publish')))
                 {
                    $is_publish = Request::get('is_publish');
                    if($is_publish == 100)
                    {
                        $is_publish = 0;
                    }
                    $return = $return->where('blogs.is_publish', '=', $is_publish);
                 }
                 if(!empty(Request::get('status')))
                 {
                    $status = Request::get('status');
                    if($status == 100)
                    {
                        $status = 0;
                    }
                    $return = $return->where('blogs.status', '=', $status);
                 }
                 if(!empty(Request::get('start_date')))
                 {
                    $return = $return->where('blogs.created_at', '>=', Request::get('start_date'));
                 }
                 if(!empty(Request::get('end_date')))
                 {
                    $return = $return->where('blogs.created_at', '<=', Request::get('end_date'));
                 }

                 $return = $return->where('blogs.is_delete', '=', 0)
                 ->orderBy('id', 'desc')
                 ->paginate(10);
                 return $return;
    }

    public function getImage()
    {
        if(!empty($this->blog_image) && file_exists('upload/blog/'.$this->blog_image))
        {
            return url('upload/blog/'.$this->blog_image);
        }
        else
        {
            return "";
        }
    }

    public function getTag()
    {
        return $this->hasMany(BlogTags::class, 'blog_id');
    }

    public function getComment()
    {
        return $this->hasMany(BlogComment::class, 'blog_id')->orderBy('blog_comments.id', 'desc');
    }

    public function getCommentCount()
    {
        return $this->hasMany(BlogComment::class, 'blog_id')->count();
    }
}
