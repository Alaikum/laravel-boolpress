@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1>Elenco di posts:</h1>
            </div>
        </div>
    </div>

    <div class="container">
        <a href="{{ route('admin.posts.create') }}">Crea</a>
        <div class="row">
            <div class="col-12">
                @foreach ($posts as $post)
                    <h2>{{ $post->title }}</h2>
                    <p>Slug:{{ $post->slug }}</p>
                    <p>Creato:{{ $post->created_at }}</p>
                    <p><strong>Post:</strong>{{ $post->content }}</p>
                    <p><strong>{{ $post->category ? $post->category->name : 'nessuna categoria' }}</strong></p>
                    <ul>
                        Tags:
                        @foreach ($post->tags as $tag)
                            <li> {{$tag->name}}</li>
                        @endforeach
                    </ul>
                    <a href="{{ route('admin.posts.show', $post) }}">Dettaglio</a>
                    <a href="{{ route('admin.posts.edit', $post) }}">Modifica</a>
                    <form action="{{ route('admin.posts.destroy', $post) }}" method="POST">

                        @csrf
                        @method('DELETE')

                        <input type="submit" value="Elimina">
                @endforeach
            </div>
        </div>
    </div>
@endsection
