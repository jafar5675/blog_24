<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogTags extends Model
{
    use HasFactory;

    protected $table = 'blog_tags';

    static public function InsertDeleteTag($blog_id, $tags)
    {
         BlogTags::where('blog_id','=',$blog_id)->delete();
         if(!empty($tags))
         {
            $tagsarray = explode(",",$tags);
            foreach($tagsarray as $tag)
            {
                $blog = new BlogTags;
                $blog->blog_id = $blog_id;
                $blog->name = trim($tag);
                $blog->save();
            }
         }
    }
}