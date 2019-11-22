@extends('layouts.app')
@section('content')
<h1>Posts details</h1>
<ul class="list-group">
  
    
         <li class="list-group-item">
           <h3> {!!$post->title!!}</h3>
       <p>{!!$post->body!!}</p>
         {{--  <img src="/storage/cover_images/{!!$post->cover_image!!}" width="300px" height="300px">
           --}}
         <img  src="{{$path}}/{{$post->cover_image}}"width="300px"  height="300px">
       <p>Created at :  {{$post->created_at}}<br> {{$post->user['name']}}</p>
       <br>
       <table><tr><td>
          <a class="btn btn-primary " href=/dashboard role="button">Back</a>
                 @if (!Auth::guest())
          @if (Auth::user()->id==$post->user_id)
              
         
            
        
   </td><td>
     <a href="/posts/{{$post->id}}/edit" class="btn btn-warning"  >Edit</a></td><td>
  <div style="float:right">
  {!! Form::open(['action'=>['PostsController@destroy',$post->id],'method'=>'post'])!!}
  {!! Form::hidden('_method','DELETE')!!}
  {!! Form::submit('Delete',['class'=>'btn btn-danger'])!!}
  {!! Form::close() !!}
  </div></td></tr>
  @endif 
  @endif
        </li>
    </ul>
@endsection