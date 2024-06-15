<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\BlogTags;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
   public function blog()
   {
    $data['getRecord'] = Blog::getRecord();
    return view('admin.blog.list',$data);
   }

   public function add_blog()
   {
    $data['getCategory'] = Category::getCategory();
    return view('admin.blog.add', $data);
   }

   public function insert_blog(Request $request)
   {
       $blog = new Blog;
       $blog->user_id = Auth::user()->id;
       $blog->title = trim($request->title);
       $blog->category_id = trim($request->category_id);
       $blog->description = trim($request->description);
       $blog->meta_description = trim($request->meta_description);
       $blog->meta_keywords = trim($request->meta_keywords);
    //    $blog->tags = trim($request->tags);
       $blog->is_publish = trim($request->is_publish);
       $blog->status = trim($request->status);
       $blog->save();

       $slug = Str::slug($request->title);
       $checkSlug = Blog::where('slug', '=', $slug)->first();
       if(!empty($checkSlug))
       {
       $dbslug = $slug.'-'.$blog->id;
       }
       else
       {
       $dbslug = $slug;
       }
       $blog->slug = $dbslug;

       if(!empty($request->file('blog_image')))
       {
        $ext = $request->file('blog_image')->getClientOriginalExtension();
        $file = $request->file('blog_image');
        $filename = $dbslug.'.'.$ext;
        $file->move('upload/blog/',$filename);
        $blog->blog_image = $filename;
       }

       $blog->save();

       BlogTags::InsertDeleteTag($blog->id, $request->tags);

       return redirect('admin/blog/list')->with('success', "Blog Successfully Created");
   }

   public function edit_blog($id)
    {
        $data['getCategory'] = Category::getCategory();
        $data['getRecord'] = Blog::getSingle($id);
        return view('admin.blog.edit', $data);
    }

    public function update_blog($id, Request $request)
    {
        $blog = Blog::getSingle($id);
        $blog->user_id = Auth::user()->id;
        $blog->title = trim($request->title);
        $blog->category_id = trim($request->category_id);
        $blog->description = trim($request->description);
        $blog->meta_description = trim($request->meta_description);
        $blog->meta_keywords = trim($request->meta_keywords);
        // $blog->tags = trim($request->tags);
        $blog->is_publish = trim($request->is_publish);
        $blog->status = trim($request->status);
        $blog->save();

        if(!empty($request->file('blog_image')))
        {
            if(!empty($blog->getImage()))
            {
                unlink('upload/blog/'.$blog->blog_image);
            }
         $ext = $request->file('blog_image')->getClientOriginalExtension();
         $file = $request->file('blog_image');
         $filename = $blog->slug.'.'.$ext;
         $file->move('upload/blog/',$filename);
         $blog->blog_image = $filename;
        }

        $blog->save();

        BlogTags::InsertDeleteTag($blog->id, $request->tags);

        return redirect('admin/blog/list')->with('success', "Blog Successfully Updated");
    }

    public function delete_blog($id)
    {
        $blog = Blog::getSingle($id);
        $blog->is_delete = 1;
        $blog->save();

        return redirect()->back()->with('warning', "Blog Successfully Deleted");
    }

}
