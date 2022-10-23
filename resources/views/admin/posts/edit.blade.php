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
                <form action="{{ route('admin.posts.update',$post) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <p>
                        <label for="title">Modifica Titolo</label>
                        <input type="text" name='title' id='title'
                        value="{{ old('title', $post->title)}}"
                            placeholder="titolo" >
                    </p>
                    <p>
                        <label for="content">Modifica Contenuto</label>
                      <textarea name="content" id="content" cols="30" rows="20" placeholder="Contenuto del Post"
                      
                     >{{ old('content',$post->content)}}</textarea>
                    </p>
                    <label for="category">Categoria</label>
                    <select name="category_id" id="" required value="{{old('category',$post->category)}}">
                        <option value=" ">--nessuna--</option>
                      @foreach ($categories as $category)
                          
                      <option @if(old('cateory_id')===$category->id) selected @endif value="{{$category->id}}">{{$category->name}}</option>
                      @endforeach
                
                    </select>
                    <button type="submit" >Posta</button>
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