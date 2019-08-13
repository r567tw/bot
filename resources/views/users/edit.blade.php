@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Edit User</div>

                <div class="card-body">
                    <form action="{{ route('users.update',$user->id)}}" method="POST">
                        @method('PUT')
                        @csrf
                        <label for="name">Name</label>
                        <input id="name" type="text" name="name" placeholder="Please input your name"
                            value="{{ $user->name }}" required>

                        <label for="Email">Email</label>
                        <input type="email" name="email" placeholder="Please input your email"
                            value="{{ $user->email }}" required>

                        <label for="admin">Admin Attribute</label>
                        <select name="is_admin" id="admin" required>
                            @foreach (['否','是'] as $key=>$item)
                            @if ($key == $user->is_admin)
                            <option value="{{ $key }}" selected>{{ $item }}</option>
                            @else
                            <option value="{{ $key }}">{{ $item }}</option>
                            @endif
                            @endforeach
                        </select>

                        <label for="developer">Developer Attribute</label>
                        <select name="is_developer" id="developer" required>
                            @foreach (['否','是'] as $key=>$item)
                            @if ($key == $user->is_developer)
                            <option value="{{ $key }}" selected>{{ $item }}</option>
                            @else
                            <option value="{{ $key }}">{{ $item }}</option>
                            @endif
                            @endforeach
                        </select>

                        <input type="submit" value="送出" class="btn btn-default">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
