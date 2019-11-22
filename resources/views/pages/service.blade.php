@extends('layouts.app')
@section('content')
    <h1>{{$tit}}</h1>
    
    @if (Count($services)>0)
    <ul class="list-group">
        @foreach ($services as $ser)
    <li class="list-group-item">{{$ser}}</li>
        @endforeach
    </ul>
        
    @endif
@endsection