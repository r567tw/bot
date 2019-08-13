@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Show Post</div>

                <div class="card-body">
                        {{ csrf_field() }}
                        <label for="title">Talker Name</label>
                            <input disabled id="title" class="input-group" type="text" name="title" value="{{ $chat->user->name }}">
                        <br/>
                        <label for="content">Message</label>
                        <br/>
                        {{ $chat->message }}
                        <br/>
                        <br/>
                        <a class="btn btn-primary" href="/chats">Return Chats</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
