@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Manage Users</div>

                <div class="card-body">
                    <p>
                        <a class="btn btn-success" href="{{ route('users.create') }}">Create</a>
                    </p>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <td>User Name</td>
                                    <td>Email</td>
                                    <td>管理員</td>
                                    <td>開發者</td>
                                    <td>Action</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->admin }}</td>
                                    <td>{{ $user->developer }}</td>
                                    <td>
                                        <a class="btn btn-info" href="{{ route('users.edit',$user->id) }}">Edit</a>
                                        <form style="display:inline" class="inline"
                                            action="{{ route('users.destroy',$user->id) }}" method="POST">
                                            {{ csrf_field() }}
                                            @method("DELETE")
                                            <input class="btn btn-danger" type="submit" value="Delete">
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
