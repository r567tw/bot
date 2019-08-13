@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Show Post</div>

                <div class="card-body">
                        {{ csrf_field() }}
                        <label for="title">Post Title</label>
                        <input disabled id="title" class="input-group" type="text" name="title" value="{{ $post->title }}">
                        <br/>
                        <label for="content">Post Content</label>
                        <br/>
                        {{ $post->content }}
                        <br/>
                        <br/>
                        <a class="btn btn-primary" href="/posts">Return Posts</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
