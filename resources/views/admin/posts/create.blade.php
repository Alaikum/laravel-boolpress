@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1>Crea il post:</h1>
            </div>
        </div>
    </div>

    <div class="container">
     
        <div class="row">
            <div class="col-12">
                <form action="{{ route('admin.posts.store') }}" method="POST">
                    @csrf
                    <p>
                        <label for="title">titolo</label>
                        <input type="text" name='title' id='title'
                        value="{{ old('title')}}"
                            placeholder="titolo" >
                    </p>
                    <p>
                        <label for="content">Contenuto</label>
                      <textarea name="content" id="content" cols="30" rows="20" placeholder="Contenuto del Post"
                      
                     >{{ old('content')}}</textarea>
                    </p>
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