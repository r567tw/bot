<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Chat;

class ChatTest extends TestCase
{
    // use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testLoginedUserCanSeeChats()
    {
        $this->withExceptionHandling();
        $chats = factory('App\Chat', 5)->create();

        $user = factory('App\User')->create();
        $this->actingAs($user);

        $response = $this->get('/chats');
        $response->assertStatus(200);

        foreach ($chats as $key => $chat) {
            $response->assertSeeText($chat->sentense);
        }
    }

    public function testNotLoginedUserCannotSeeChats()
    {
        $response = $this->get('/chats');
        $response->assertRedirect('login');
    }
}
