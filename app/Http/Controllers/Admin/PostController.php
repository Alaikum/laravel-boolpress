<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Mail\SendNewMail;
use App\Post;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
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
        $posts = Post::limit(150)->orderBy('id','desc')->get();
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
            'tags.*' => 'exists:tags,id', //i valori esistono nella colonna id, niente nullable perchè non arrivono valori nulli
            //il .* serve per indicare meglio l errore
            'cover' => 'nullable|image|max:2048'  //non supera i due mega, ragiona in kilobyte
        ]);

        $params['slug'] = Post::getUniqueSlugFromTitle($params['title']);

        if (array_key_exists('cover', $params)) {

            $img_path = Storage::put('post_covers', $request->file('cover'));

            $params['cover'] = $img_path;
        }

        $post = Post::create($params);

        //agganciare i tags dopo creazione post

        //controllo se esiste chiave tags
        if (array_key_exists('tags', $params)) {
            $tags = $params['tags'];
            $post->tags()->sync($tags);
        }
        Mail::to($request->user())->send(new SendNewMail($post));

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
            'tags.*' => 'exists:tags,id',
            'cover' => 'nullable|image|max:2048'
        ]);

        if ($params['title'] !== $post->title) {
            $params['slug'] = Post::getUniqueSlugFromTitle($params['title']);
        }
        
        if (array_key_exists('cover', $params)) {

            $img_path = Storage::put('post_covers', $request->file('cover'));

            $params['cover'] = $img_path;
        }


        //   $params['slug']=str_replace(' ','-', $params['title']);
        $post->update($params);

        if (array_key_exists('tags', $params)) {
            $post->tags()->sync($params['tags']);
        } else {
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
        //così se elimino il post rimane comunque salvato il percoso per eliminare la cover
        $cover = $post->cover;
        $post->delete();
        //elimino la foto dopo l'eliminazione del post
        if ($cover && Storage::exists($cover)) {
            Storage::delete($cover);
        }




        return redirect()->route('admin.posts.index');
    }
}
