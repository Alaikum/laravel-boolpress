<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Str;

class Post extends Model
{
    protected $fillable=[
        'title',
        'content',
        'slug',
        'category_id'
    ];
    public function category(){
        return $this->belongsTo('App\Category');
    }

    public function tags(){
        return $this->belongsToMany('App\Tag');
    }

    static public function getUniqueSlugFromTitle($title){

        $slug_base = Str::slug($title);
        $slug=$slug_base;
        //controllare che sia unico
        //usando una query sql
        $post_esistente = Post::where('slug', $slug_base)->first();
        $counter = 1;
        //se il post esiste cambio slug e rifaccio la ricerca
        while ($post_esistente) {
            $slug = $slug_base .'-'.$counter;
            $post_esistente = Post::where('slug', $slug)->first();
            $counter++;
        }
        return $slug;
    }
}

