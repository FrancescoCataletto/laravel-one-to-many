@extends('layouts.app')

@section('content')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>
                    {{$error}}
                </li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{route('admin.posts.update', $post)}}" method="POST">
    @csrf

    @method('PUT')

    <div class="form-group">
      <label for="title">Title</label>
      <input type="text" class="form-control @error('title') isInvalid
      @enderror" id="title" name="title" 
      value="{{$post->title}}"
      placeholder="Enter title">
      @error('title')
        <p class="alert alert-danger">{{$message}}</p>
      @enderror
    </div>

    <div class="form-group">
      <label for="text">Text</label>
      <input type="text" class="form-control @error('text') isInvalid
      @enderror" name="text" 
      value="{{$post->text}}"
      placeholder="Text">
      @error('text')
          <p class="alert alert-danger">{{$message}}</p>
      @enderror
    </div>
    
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
@endsection