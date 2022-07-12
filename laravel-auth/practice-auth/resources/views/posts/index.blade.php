@extends('posts/layout')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-6">
                    <h3>Posts Management</h3>
                </div>
                <div class="col-md-6">                    
                    <a href="{{ route('posts.create') }}" class="btn btn-primary float-end">Create Posts</a>
                    <a href="{{ url('/home') }}" class="btn btn-success">Home</a>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>
                        Id
                    </th>
                    <th>
                        Title
                    </th>
                    <th>
                        Content
                    </th>
                    <th>
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($post as $ps)
                <tr>
                    <td>{{++$i}}</td>
                    <td>{{$ps->title}}</td>
                    <td>{{$ps->content}}</td>
                    <td>
                        <form action="{{ route('posts.delete', $ps-> id) }}" method="POST">
                            @can('update', $post)
                            <a href="{{ url('/posts/edit' . '/' . $ps-> id) }}" class="btn btn-info">Edit</a>
                            @endcan
                            @csrf
                            @method('DELETE')
                            @can('delete', $post)
                            <button type="submit" class="btn btn-danger">Delete</button>
                            @endcan
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection