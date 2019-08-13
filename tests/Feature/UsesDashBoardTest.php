<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UsesDashBoardTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testDeveloperCanCreateUser()
    {
        $this->actingAs(factory('App\User')->create(['is_admin' => true]));
        $response = $this->json('GET', '/api/users/create');
        $response->assertOk();
    }

    public function testNonDeveloperCanNotCreateUser()
    {
        $this->actingAs(factory('App\User')->create(['is_admin' => false]));
        $response = $this->json('GET', '/api/users/create');
        $response->assertForbidden();
    }

    public function testDeveloperCanEditUser()
    {
        $this->assertTrue(true);
    }

    public function testDeveloperUpdateUser()
    {
        $this->assertTrue(true);
    }

    public function testDeveloperDeleteUser()
    {
        $this->assertTrue(true);
    }
}
