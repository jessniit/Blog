@extends('layouts.app')
@section('content')
<h1>All Posts</h1>
@if (count($posts)>0)
<ul class="list-group">
   @foreach ($posts as $item)
    
           
<li class="list-group-item">
<a href="posts/{{$item->id}}" class="text-dark btn"><h3>{{$item->title}}</h3></a> 
    
<p> Written by :  {{$item->created_at}}||by {{$item->user['name']}}</p></li>
   

   @endforeach </ul>
   <br>
   {{$posts->links()}}
@else
<p>no posts found</p>
    
@endif

@endsection