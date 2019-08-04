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
        $lineService = new LineBotService();
        $response = $lineService->pushMessage(env('LINE_USER_ID'),'Test Hello World');

        $this->assertEquals(200, $response->getHTTPStatus());
    }

    // public function testBuildImagesMessageBuilder()
    // {
    //     $lineService = new LineBotService(env('LINE_USER_ID'));

    //     $data = [
    //                 [
    //                     'imagePath' => 'https://i.imgur.com/BlBH2HE.jpg',
    //                     'directUri' => 'https://github.com/Tai-ch0802/php-crawler-chat-bot',
    //                     'label' => '自己玩的linebot',
    //                 ],
    //                 [
    //                     'imagePath' => 'https://i.imgur.com/XJkiup5.jpg',
    //                     'directUri' => 'https://zh.wikipedia.org/wiki/%E7%8C%AB',
    //                     'label' => '喵星人',
    //                 ]
    //     ];
    //     $targets = $lineService->buildImagesMessageBuilder($data, '今日金句');
    //     foreach ($targets as $target) {
    //         $response =  $lineService->pushMessage($target);
    //         $this->assertEquals(200, $response->getHTTPStatus());
    //     }
    // }
}
