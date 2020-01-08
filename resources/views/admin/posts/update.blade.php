@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">posts</div>

                <div class="card-body">
                  <form action="/posts/{{$post->id}}" method="post">
                    {{method_field('patch')}}
                    {{csrf_field()}}
                    <div class="form-group">
                      <label for="Title">Title</label>
                      <input type="text" name="title" class="form-control" id="title" aria-describedby="titleHelp" placeholder="Enter title" value="{{$post->title}}">
                      <small id="titleHelp" class="form-text text-muted">Title should not greater than 200 char</small>
                      <small id="titleHelp" class="form-text" style="color:red">@if($errors->has('title')) {{$errors->first('title') }} @endif</small>
                    </div>
                    <div class="form-group">
                      <label for="Body">Body</label>
                      <textarea name="content" rows="8" cols="80"class="form-control" id="content" placeholder="Enter content here">{{$post->body}}</textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
