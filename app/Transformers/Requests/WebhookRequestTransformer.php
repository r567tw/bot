<?php
namespace App\Transformers\Requests;

class WebhookRequestTransformer
{
    public function tramsforRequest($event){
        //input ::[{"type":"message","replyToken":"c4c8ea048caa4174974173f57c87ec2c","source":{"userId":"U852ac49f59e5acd69648a9bcd5b99299","type":"user"},"timestamp":1564891686344,"message":{"type":"text","id":"10331012857009","text":"J"}}]
        return [
            'type' => $event['type'],
            'userId' => $event['source']['userId'],
            'content' => [
                'type' => $event['message']['type'],
                'text' => $this->tramsforTextMessage($event['message']['text'])
            ]
        ];
    }

    private function tramsforTextMessage($message){
        //將訊息全形英數轉半形
        $message = mb_convert_kana($message,'a');
        return $message;
    }

}
