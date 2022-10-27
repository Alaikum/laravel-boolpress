@component('mail::message')
# Stile di Laravel per le Email
 
Evviva! Hai creato un nuovo post
 
@component('mail::button', ['url' => route('admin.posts.show',$post)])
{{$post->title}}
@endcomponent
 
Nuovo Post Pubblicato<br>
{{ config('app.name') }}
@endcomponent


{{-- <label for="">Titolo del nuovo post:</label>
<h1>
   <a href="{{route('admin.posts.show',$post)}}">
       {{$post->title}}
   </a>
</h1> --}}