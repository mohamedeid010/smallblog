@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">posts</div>

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
                            <td>{{$post->title}}</td>
                            <td>{{$post->user->name}}</td>
                            <td>@mdo</td>
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
