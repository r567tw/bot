<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use  App\Chat;
use Illuminate\Support\Facades\Auth;

class ChatRoomController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        return view('chatroom.index');
    }

    public function store(Request $request)
    {
        $chat = new Chat();
        $chat->user_id = auth()->user()->id;
        $chat->message = $request->message;
        $chat->save();

        return $chat;
    }
}
