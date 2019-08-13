@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                @if (!empty($chat->name))
                    <div class="card-header">Update Message</div>
                @else
                    <div class="card-header">Create new Message</div>
                @endif
                <div class="card-body">
                    @if (!empty($chat->message))
                        <form class="form" action="{{ route('chats.update',$chat->id)}}" method="post">
                        @method('PUT')
                    @else
                        <form class="form" action="{{ route('chats.store')}}" method="post">
                    @endif
                        @csrf
                        <label for="email">Message</label>
                        <input id="email" class="input-group" type="text" name="message" placeholder="Please input message" value="{{ $chat->message }}">
                        <br/>
                        @if (!empty($chat->message))
                            <button class="btn btn-warning">Let's Update Message!</button>
                        @else
                            <button class="btn btn-success">Let's Create New Message!</button>
                        @endif
                        <a class="btn btn-primary" href="/chats">Return Chats</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
