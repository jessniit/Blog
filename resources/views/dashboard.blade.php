@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                <div class="pannel-body">
                        <a href="/posts/create" class="btn btn-success">Create New Post</a>
                        <p></p>
                        <h3> Your Blog Posts.....</h3>
                        @if (count($posts)>0)
                        <table class="table">

                        <tr>
                            <th>Title</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                        @foreach ($posts as $p)
                            <tr>
                            <td><a href="/posts/{!!$p->id!!}" class="text-dark btn">{{$p->title}}</a></td>
                            <td><a href="/posts/{{$p->id}}/edit" class="btn btn-warning"> Edit</a></td>
                                <td>  {!! Form::open(['action'=>['PostsController@destroy',$p->id],'method'=>'post'])!!}
                                        {!! Form::hidden('_method','DELETE')!!}
                                        {!! Form::submit('Delete',['class'=>'btn btn-danger'])!!}
                                        {!! Form::close() !!}</td>
                            </tr>
                        @endforeach

                        </table> 
                        @else
                            <h4>no posts found</h4>
                        @endif
                    </div>    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
