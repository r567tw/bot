<?php

namespace Tests\Unit\Services;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Services\LineBotService;

class LineBotServiceTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testPushMessage()
    {
        $lineService = new LineBotService(env('LINE_USER_ID'));
        $response = $lineService->pushMessage('Test Sub-bot can push message');

        $this->assertEquals(200, $response->getHTTPStatus());
    }
}
