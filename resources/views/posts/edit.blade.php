@extends('layouts.app')
@section('content')
<h1>Edit post</h1>
{!! Form::open(['action'=>['PostsController@update',$post->id],'methode'=>'post','enctype'=>'multipart/form-data']) !!}
    <div class="form_group">
        <?php echo Form::label('title', 'Enter Title',['class'=>'awesome']);?>
        <?php echo Form::text('ettl',$post->title,['class'=>'form-control']); ?>
    </div>

    <div class="form_group">
        <?php echo Form::label('body', 'Enter Blogcontent',['class'=>'awesome']); ?>
        <?php echo Form::textarea('ebdy',$post->body,['id'=>'article-ckeditor','class'=>'form-control','placeholder'=>'body']); ?>
      </div>
      <div class="form_group">
        <?php echo Form::label('cover_image', 'Edit image',['class'=>'awesome']); ?>
        <?php echo Form::file('cover_image'); ?>
        {!!$post->cover_image!!}
      </div>
<br>
<div class="form-group">
    <?php echo form::hidden('_method','PUT');?>
       <?php echo Form::submit('Update',['class'=>'btn btn-success']); ?>
</div>

      {!! Form::close() !!}




@endsection