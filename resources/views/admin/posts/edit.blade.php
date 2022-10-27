@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1>Modifica il post:</h1>
            </div>
        </div>
    </div>

    <div class="container">

        <div class="row">
            <div class="col-12">
                <form action="{{ route('admin.posts.update', $post) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="input-group mb-3">
                        @if ($post->cover)
                            <div class="cover__post">
                                <label for="cover" aria-describedby="inputGroupFileAddon02">Scegli
                                    la cover</label>
                                <input type="file" id="cover" name="cover" style="display:none;"
                                    value="{{ old('cover', $post->cover) }}">

                                <p class="have__cover">
                                    Questa è la cover salvata: <br> {{ $post->cover }}

                                </p>
                            @else
                                <div class="cover__post">
                                    <label for="cover" aria-describedby="inputGroupFileAddon02">Scegli
                                        la cover</label>
                                    <input type="file" id="imgInp" name="cover" value="{{ old('cover') }}">
                                    <img id="blah" />
                        @endif
                    </div>

            </div>
            <p>
                <label for="title">Modifica Titolo</label>
                <input type="text" name='title' id='title' value="{{ old('title', $post->title) }}"
                    placeholder="titolo">
            </p>
            <p>
                <label for="content">Modifica Contenuto</label>
                <textarea name="content" id="content" cols="30" rows="20" placeholder="Contenuto del Post">{{ old('content', $post->content) }}</textarea>
            </p>
            <label for="category">Categoria</label>
            <select name="category_id" id="" required value="">
                <option value=" ">--nessuna--</option>
                @foreach ($categories as $category)
                    <option @if (old('category_id', $post->category_id) == $category->id) selected @endif value="{{ $category->id }}">
                        {{ $category->name }}</option>
                @endforeach

            </select>

            <div class="form-group">
                <label for="tags"> Tags: </label>
                @foreach ($tags as $tag)
                    <div class="form-check form-check-inline">
                        {{-- il name per il tag va scritto con le quadre,così le salva come array  --}}
                        <input class="form-check-input" name="tags[]" {{-- per ottenere solo id dei tags uso pluck --}}
                            @if (in_Array($tag->id, old('tags', $post->tags->pluck('id')->all()))) checked @endif type="checkbox" id="tag-{{ $tag->id }}"
                            value="{{ $tag->id }}">
                        <label class="form-check-label" for="tag-{{ $tag->id }}">{{ $tag->name }}</label>
                    </div>
                @endforeach

            </div>
            <button type="submit">Posta</button>
            </form>

        </div>
    </div>
    </div>

    {{-- STAMPA L'ERRORE  --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
@endsection
