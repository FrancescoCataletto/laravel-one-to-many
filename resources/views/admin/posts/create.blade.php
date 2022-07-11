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

<form action="{{route('admin.posts.store')}}" method="POST">
    @csrf

    <div class="form-group">
      <label for="title">Title</label>
      <input type="text" class="form-control @error('title') isInvalid
      @enderror" id="title" name="title" 
      value="{{old('title')}}"
      placeholder="Enter title">
      @error('title')
        <p class="alert alert-danger">{{$message}}</p>
      @enderror
    </div>

    <div class="form-group">
      <label for="text">Text</label>
      <input type="text" class="form-control @error('text') isInvalid
      @enderror" name="text" 
      value="{{old('text')}}"
      placeholder="Text">
      @error('text')
          <p class="alert alert-danger">{{$message}}</p>
      @enderror
    </div>

    <select class="form-select" name="category_id">
      <option selected>Seleziona una categoria</option>
      @foreach ($categories as $category)
        <option value="{{$category->id}}">{{$category->name}}</option>
      @endforeach
    </select>
    
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
@endsection