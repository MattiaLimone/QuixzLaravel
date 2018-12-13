@extends('layouts.app')

@section('title'){{ $article->title }}@endsection

  @section('script')
    <script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
    <script>tinymce.init({ selector:'textarea' });</script>
  @endsection

@section('stylesheets')
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
@endsection
@section('content')
<div class="row">
  <div class="col-md-8 offset-2">
    @include('errors')
  </div>
</div>

<div class="row">
  <div class="col-md-8 offset-2">
  {!! Form::model($article, array('route' => array('news.update', $article->id), 'files' => true, 'method' => 'PUT')) !!}﻿
    {{ Form::label('title', 'Title:') }}
    {{ Form::text('title', null, array('class' => 'form-control')) }}

    {{ Form::label('author', 'Author:') }}
    {{ Form::text('author', null, array('class' => 'form-control')) }}
<div class="row">
  <div class="col">
    <h5>Current Image:</h5>
    <img style="width: 100%" src=" {{ asset('images/' . $article->image) }} " alt=""> <br>
  </div>
  <div class="col">
    {{ Form::label('image', 'Image:') }}
    {{ Form::file('image', array('class' => 'form-control')) }}
  </div>

</div>

  <label for="category__id">Category:</label>
  <select name="category_id" class="form-control">
    <option value="{{ $article->category->id }}">{{ $article->category->name }}</option>
    @foreach ($categories as $category)
        <option value="{{ $category->id }}">{{ $category->name }}</option>
    @endforeach
  </select>
      <br>

    {{ Form::label('body', 'Body:')}}
    {{ Form::textarea('body', null, array('class' => 'form-control')) }}

    {{ Form::submit('Update', array('class' => 'btn btn-success btn-block')) }}
  {!! Form::close() !!}

  {!! Form::model($article, array('route' => array('news.destroy', $article->id), 'files' => true, 'method' => 'DELETE')) !!}﻿
  {{ Form::submit('Delete', array('class' => 'btn btn-danger btn-block')) }}
  {!! Form::close() !!}
  <a class="btn btn-block btn-secondary" href="/news" style="color: #fff">Cancel</a>
 </div>
</div>
