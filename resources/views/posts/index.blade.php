@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Post Dashboard</div>

                <div class="card-body">
                    <a class="btn btn-success" style="margin-bottom:20px" href="{{ route('posts.create')}}">Create</a>

                    <table class="table">
                        <thead>
                            <th>Title</th>
                            <th>Author</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            @foreach ($posts as $post)
                            <tr>
                                <td>{{ $post->title }}</td>
                                <td>{{ $post->author }}</td>
                                <td>
                                    <a class="btn btn-info" href="{{ route('posts.edit',$post->id) }}">Edit</a>
                                    <a class="btn btn-success" href="{{ route('posts.show',$post->id) }}">Show</a>
                                    <form style="display:inline" action="{{ route('posts.destroy',$post->id) }}"
                                        method="post">
                                        @method('delete')
                                        {{ csrf_field() }}
                                        <button class="btn btn-danger" type="submit">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                            <td></td>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection