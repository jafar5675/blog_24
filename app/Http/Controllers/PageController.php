<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    public function page()
   {
    $data['getRecord'] = Page::getRecord();
    return view('admin.page.list',$data);
   }

   public function add_page()
   {
    return view('admin.page.add');
   }

   public function insert_page(Request $request)
   {
       $page = new Page;
       $page->title = trim($request->title);
       $page->slug = trim($request->slug);
       $page->description = trim($request->description);
       $page->meta_description = trim($request->meta_description);
       $page->meta_keywords = trim($request->meta_keywords);
       $page->meta_title = trim($request->meta_title);
       $page->save();

       return redirect('admin/page/list')->with('success', "page Successfully Created");
   }

   public function edit_page($id)
    {
        $data['getRecord'] = Page::getSingle($id);
        return view('admin.page.edit', $data);
    }

    public function update_page($id, Request $request)
    {
        $page = Page::getSingle($id);
        $page->title = trim($request->title);
        $page->slug = trim($request->slug);
        $page->description = trim($request->description);
        $page->meta_description = trim($request->meta_description);
        $page->meta_keywords = trim($request->meta_keywords);
        $page->meta_title = trim($request->meta_title);
        $page->save();

        return redirect('admin/page/list')->with('success', "page Successfully Updated");
    }

}