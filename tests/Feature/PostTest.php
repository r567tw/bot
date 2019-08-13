<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use App\Post;
use App\Http\Middleware\VerifyCsrfToken;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PostTest extends TestCase
{
    // use WithoutMiddleware;
    // use DatabaseTransactions;
    // use RefreshDatabase;
    /**
     * A basic feature test example.
     * @test
     * @return void
     */

    public function testNotLoginedUserCannotSeePostIndex()
    {
        $response = $this->get('/posts');

        $response->assertRedirect('/login');
    }

    public function testLoginedUserCanSeePostIndex()
    {
        $user = factory('App\User')->create();
        $this->actingAs($user);
        $response = $this->get('/posts');

        $response->assertStatus(200);
    }

    public function testNotLoginedUserCannotUpdatePost()
    {
        $response = $this->get('/posts');

        $response->assertRedirect('/login');
    }


    public function testLoginedUserCanUpdatePost()
    {
        $this->withoutMiddleware(VerifyCsrfToken::class);

        $user = factory('App\User')->create(['is_admin' => 1]);
        $post = factory('App\Post')->create(['user_id' => $user->id]);

        $this->actingAs(User::find($user->id));

        $response = $this->put(route('posts.update', $post->id), ['title' => 'test']);

        $this->assertDatabaseHas('posts', ['title' => 'test']);
        $this->assertDatabaseMissing('posts', $post->toArray());
        $response->assertRedirect('/posts');
    }
}
