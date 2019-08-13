@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Chats Record Dashboard</div>

                <div class="card-body">
                    <a class="btn btn-success" style="margin-bottom:20px" href="{{ route('chats.create')}}">Create</a>

                    <table class="table">
                        <thead>
                            <th>Talker</th>
                            <th>Message</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            @foreach ($chats as $chat)
                            <tr>
                                <td>{{ $chat->user->name }}</td>
                                <td>{{ $chat->message }}</td>
                                <td>
                                    <a class="btn btn-primary" href="{{ route('chats.show',$chat->id) }}">Show</a>
                                    <a class="btn btn-warning" href="{{ route('chats.edit',$chat->id) }}">Update</a>
                                    <form style="display:inline" action="{{ route('chats.destroy',$chat->id) }}" method="post">
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
