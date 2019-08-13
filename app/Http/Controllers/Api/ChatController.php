<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Chat;
use App\Http\Controllers\Controller;

class ChatController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth:api');
        //$this->middleware('isAdmin')->only(['edit','update','destroy']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->transform(Chat::orderBy('created_at','desc')->take(5)->get());
    }

    public function transform($chats){
        $chats_sorted = $chats->sortByDesc(function ($chat, $key) {
            return $chat->id;
        });

        return $chats_sorted->map(function($chat){
            return [
                'id'            => (int) $chat->id,
                'user'          => (string) $chat->user->name,
                'message'      => (string) $chat->message,
            ];
        });
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $chat = new Chat();
        $chat->user_id = $request->user_id;
        $chat->sentense = $request->sentense;
        $chat->save();

        return $chat;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Chat $chat)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Chat $chat)
    {
        $chat->sentense = $request->sentense;
        $chat->save();
        return $chat;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Chat $chat)
    {
        $chat->delete();
        return true;
    }
}
