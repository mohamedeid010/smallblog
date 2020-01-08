@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">posts</div>
                @if(Session::has('message'))
                <div class="alert alert-success" role="alert">
                  {{session('message')}}
                </div>
                @endif
                <div class="card-body">
                  <a href="/posts/create" class="btn btn-primary">create Post</a>
                    <table class="table table-striped">
                      <thead class="thead-dark">
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Title</th>
                            <th scope="col">Owner</th>
                            <th scope="col">Control</th>
                          </tr>
                        </thead>
                        @if($posts->count())
                        <tbody>
                          @foreach($posts as $post)
                          <tr>
                            <th scope="row">{{$post->id}}</th>
                            <td><a href="/posts/{{$post->id}}">{{$post->title}}</a></td>
                            <td>{{$post->user->name}}</td>
                            <td>
                              <a href="/posts/{{$post->id}}/edit" class="btn btn-primary">Edit</a>
                              <form action="/posts/{{$post->id}}" method="post" class="delete-form">
                                {{method_field('delete')}}
                                {{csrf_field()}}
                                <input type="submit" name="Delete" value="Delete" class="btn btn-danger">
                              </form>

                            </td>
                          </tr>
                          @endforeach
                        </tbody>
                        <tfoot>
                          <tr>
                            <td colspan="4">{{ $posts->links() }}</td>
                          </tr>
                        </tfoot>
                        @else
                        <tbody>
                          <tr>
                            <th colspan="4" scope="row">No results</th>
                          </tr>
                        </tbody>
                        @endif

                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
