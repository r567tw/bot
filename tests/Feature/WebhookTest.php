<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class WebhookTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testGetDailyAstro()
    {
        $request = $this->webhookRequest('本日運勢');
        $response = $this->post('webhook', $request);

        $response->assertStatus(200);
        $response->assertSeeText('今日射手座解析');
    }

    public function testGetWeeklyAstro()
    {
        $this->withoutExceptionHandling();

        $request = $this->webhookRequest('本周運勢');
        $response = $this->post('webhook', $request);

        $response->assertStatus(200);
        $response->assertSeeText('本周運勢:');
    }

    public function testGetTodayWeather()
    {
        $request = $this->webhookRequest('今日天氣');
        $response = $this->post('webhook', $request);

        $response->assertStatus(200);
        $response->assertSeeText('今日天氣:');
    }

    public function testGetTaitungTodayWeather()
    {
        $request = $this->webhookRequest('今日天氣:臺東縣');
        $response = $this->post('webhook', $request);

        $response->assertStatus(200);
        $response->assertSeeText('臺東縣');
    }

    public function testGetExchangeOftwdtokrw()
    {
        $request = $this->webhookRequest('exchange:30,twd,krw');
        $response = $this->post('webhook', $request);

        $response->assertStatus(200);
        $response->assertSeeText('KRW');

    }

    public function testGetCovid19Data()
    {
        $request = $this->webhookRequest('武漢肺炎');
        $response = $this->post('webhook', $request);

        $response->assertStatus(200);
        $response->assertSeeText('新冠肺炎疫情全台狀況');

    }

    private function webhookRequest($message)
    {
        return array(
            'events' =>
            array(
                0 =>
                array(
                    'type' => 'message',
                    'replyToken' => 'b7715478ee0d447e85078161e9fad18c',
                    'source' =>
                    array(
                        'userId' => 'U852ac49f59e5acd69648a9bcd5b99299',
                        'type' => 'user',
                    ),
                    'timestamp' => 1564820945283,
                    'message' =>
                    array(
                        'type' => 'text',
                        'id' => '10326564062583',
                        'text' => $message,
                    ),
                ),
            ),
            'destination' => 'U5a81c4026d970646b63cd9ebaafe705a',
        );
    }
}
