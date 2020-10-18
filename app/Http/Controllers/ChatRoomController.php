<?php

namespace App\Http\Controllers;

use App\Chat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatRoomController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['chatroom']);
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

    public function chatroom()
    {
        return view('chatroom');
    }
}
