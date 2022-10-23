@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1>Dettaglio del post:</h1>
            </div>
        </div>
    </div>

    <div class="container">

        <div class="row">
            <div class="col-12">

                <h2>{{ $post->title }}</h2>
                <p>Slug:{{ $post->slug }}</p>
                <p>Creato:{{ $post->created_at }}</p>
                <p><strong>Post:</strong>{{ $post->content }}</p>
                Categoria:
                @if ($post->category)
                    <p>{{ $post->category->name }}</p>
                @endif
                <a href="{{ route('admin.posts.edit', $post) }}">Modifica</a>

                </form>
                <form action="{{ route('admin.posts.destroy', $post) }}" method="POST">

                    @csrf
                    @method('DELETE')

                    <input type="submit" value="Elimina">
            </div>
        </div>
    </div>
@endsection
