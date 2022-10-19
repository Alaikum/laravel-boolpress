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
        <a href="{{route('admin.posts.create')}}">Crea</a>
        <div class="row">
            <div class="col-12">
                @foreach ($posts as $post)
                    <h2>{{$post->title}}</h2>
                    <p>{{$post->slug}}</p>
                    <a href="{{route('admin.posts.show',$post)}}">Dettaglio</a>
                @endforeach
            </div>
        </div>
    </div>
@endsection