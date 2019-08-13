@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Create a new post</div>

                <div class="card-body">
                    @if (!empty($post->title))
                        <form class="form" action="{{ route('posts.update',$post->id)}}" method="post">
                        @method('PUT')
                    @else
                        <form class="form" action="{{ route('posts.store')}}" method="post">
                    @endif
                        {{ csrf_field() }}
                        <label for="title">Post Title</label>
                        <input id="title" class="input-group" type="text" name="title" placeholder="Please input your title" value="{{ $post->title }}">
                        <br/>
                        <label for="content">Post Content</label>
                        <textarea name="content" id="content" class="input-group">{{ $post->content }}</textarea>
                        <br/>
                        @if (!empty($post->title))
                            <button class="btn btn-warning">Let's Update Post!</button>
                        @else
                            <button class="btn btn-success">Let's Create a Post!</button>
                        @endif
                        <a class="btn btn-primary" href="/posts">Return Posts</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
