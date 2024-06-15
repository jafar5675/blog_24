<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function Category()
    {
        $data['getRecord'] = Category::getRecord();
       return view('admin.category.list', $data);
    }

    public function add_category()
    {
        return view('admin.category.add');
    }

    public function insert_category(Request $request)
    {
        $category = new Category;
        $category->name = trim($request->name);
        $category->slug = trim(Str::slug($request->name));
        $category->title = trim($request->title);
        $category->meta_title = trim($request->meta_title);
        $category->meta_description = trim($request->meta_description);
        $category->meta_keywords = trim($request->meta_keywords);
        $category->status = trim($request->status);
        $category->is_menu = trim($request->is_menu);
        $category->save();

        return redirect('admin/category/list')->with('success', "Category Successfully Created");
    }

    public function edit_category($id)
    {
        $data['getRecord'] = Category::getSingle($id);
        return view('admin.category.edit', $data);
    }

    public function update_category($id,Request $request)
    {
        $category = Category::getSingle($id);
        $category->name = trim($request->name);
        $category->slug = trim(Str::slug($request->name));
        $category->title = trim($request->title);
        $category->meta_title = trim($request->meta_title);
        $category->meta_description = trim($request->meta_description);
        $category->meta_keywords = trim($request->meta_keywords);
        $category->status = trim($request->status);
        $category->is_menu = trim($request->is_menu);
        $category->save();

        return redirect('admin/category/list')->with('success', "Category Successfully Updated");
    }

    public function delete_category($id)
    {
        $category = Category::getSingle($id);
        $category->is_delete = 1;
        $category->save();

        return redirect('admin/category/list')->with('error', "Your data deleted successfully");
    }
}
