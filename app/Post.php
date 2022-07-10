<?php

namespace App;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

    public function category(){
        return $this->belongsTo('App\Category');
    }

    protected $fillable = [
        'text',
        'title',
        'slug'
    ];

    public static function slugGenerator($title){
        $slug = Str::slug($title, '-');
        $original_slug = $slug;
        $post_esistente = Post::where('slug', $slug)->first();
        $c = 1;
        while($post_esistente){
            $slug = $original_slug . '-' . $c;
            $c++;
            $post_esistente = Post::where('slug', $slug)->first();
        }
        return $slug;
    }
}
