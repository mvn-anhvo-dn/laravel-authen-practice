@extends('posts/layout')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6">
                        <h3>Create Posts</h3>
                    </div>
                    <div class="col-md-6">
                        <a href="{{ route('posts.index') }}" class="btn btn-primary float-end">Posts list</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('posts.store') }}" method="post">
                @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <strong>Title</strong>
                                <input type="text" name ="title" class="form-control" placeholder="Input Title">
                            </div>
                            <div class="form-group">
                                <strong>Content</strong>
                                <input type="text" name ="content" class="form-control" placeholder="Input Content">
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success mt-2">Create</button>
            </form>
        </div>
    </div>
@endsection