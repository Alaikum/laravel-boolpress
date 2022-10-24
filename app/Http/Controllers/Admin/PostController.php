<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Post;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::limit(150)->get();
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $categories = Category::orderBy('name', 'asc')->get();
        $tags = Tag::orderBy('name', 'asc')->get();
        return view('admin.posts.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $params = $request->validate([
            'title' => 'required|max:255|min:3',
            'content' => 'required',
            'category_id' => 'nullable|exists:App\Category,id',
            'tags.*' => 'exists:tags,id' //i valori esistono nella colonna id, niente nullable perchè non arrivono valori nulli
            //il .* serve per indicare meglio l errore
        ]);

        // $slug_base = Str::slug($params['title']);
        // $slug=$slug_base;
        // //controllare che sia unico
        // //usando una query sql
        // $post_esistente = Post::where('slug', $slug_base)->first();
        // $counter = 1;
        // //se il post esiste cambio slug e rifaccio la ricerca
        // while ($post_esistente) {
        //     $slug = $slug_base .'-'.$counter;
        //     $post_esistente = Post::where('slug', $slug)->first();
        //     $counter++;
        // }
        // $params['slug'] = $slug;
        $params['slug'] = Post::getUniqueSlugFromTitle($params['title']);

        $post = Post::create($params);

        //agganciare i tags dopo creazione post

        //controllo se esiste chiave tags
        if (array_key_exists('tags', $params)) {
            $tags = $params['tags'];
            $post->tags()->sync($tags);
        }
        return redirect()->route('admin.posts.show', $post);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {

        $categories = Category::orderBy('name', 'asc')->get();
        $tags = Tag::orderBy('name', 'asc')->get();
        return view('admin.posts.edit', compact('categories', 'post', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $params = $request->validate([
            'title' => 'required|max:255|min:3',
            'content' => 'required',
            'category_id' => 'nullable|exists:App\Category,id',
            'tags.*' => 'exists:tags,id'
        ]);

        if ($params['title'] !== $post->title) {
            $params['slug'] = Post::getUniqueSlugFromTitle($params['title']);
        }


        //   $params['slug']=str_replace(' ','-', $params['title']);
        $post->update($params);

        if (array_key_exists('tags', $params)) {
            $post->tags()->sync($params['tags']);
        }else{
            $post->tags()->sync([]); //o sync con array vuoto
          //  $post->tags()->detach(); o detach con array vuoto
        }

        return redirect()->route('admin.posts.show', $post);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('admin.posts.index');
    }
}
