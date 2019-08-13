@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Create User</div>

                <div class="card-body">
                    <form action="{{ route('users.store')}}" method="POST">
                        @csrf
                        <label for="name">Name</label>
                        <input id="name" type="text" name="name" placeholder="Please input your name" required>

                        <label for="Email">Email</label>
                        <input type="email" name="email" placeholder="Please input your email" required>

                        <label for="admin">Admin Attribute</label>
                        <select name="is_admin" id="admin" required>
                            @foreach (['否','是'] as $key=>$item)
                            <option value="{{ $key }}">{{ $item }}</option>
                            @endforeach
                        </select>

                        <label for="developer">Developer Attribute</label>
                        <select name="is_developer" id="developer" required>
                            @foreach (['否','是'] as $key=>$item)
                            <option value="{{ $key }}">{{ $item }}</option>
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
