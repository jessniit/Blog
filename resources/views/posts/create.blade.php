@extends('layouts.app')
@section('content')
<h1>Create post</h1>
{!! Form::open(['action'=>'PostsController@store','methode'=>'post','enctype'=>'multipart/form-data']) !!}
    <div class="form_group">
        <?php echo Form::label('title', 'Enter Title',['class'=>'awesome']);?>
        <?php echo Form::text('ttl','',['class'=>'form-control','placeholder'=>'title']); ?>
    </div>

    <div class="form_group">
        <?php echo Form::label('body', 'Enter Blogcontent',['class'=>'awesome']); ?>
        <?php echo Form::textarea('bdy','',['id'=>'article-ckeditor','class'=>'form-control','placeholder'=>'body']); ?>
      </div>
      <div class="form_group">
        <?php echo Form::label('cover_image', 'Add imgae',['class'=>'awesome']); ?>
        <?php echo Form::file('cover_image'); ?>
      </div>
<br>
<div class="form-group">
       <?php echo Form::submit('Add Posts',['class'=>'btn btn-success']); ?>
</div>

      {!! Form::close() !!}




@endsection