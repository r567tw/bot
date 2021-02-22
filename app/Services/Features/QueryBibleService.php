<?php
namespace App\Services\Features;

use GuzzleHttp\Client;

class QueryBibleService
{
    private $client;
    private $errorMessage = '此訊息在處理過程當中有錯誤';

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function queryBible($message)
    {
        $data = $this->prepareDataForQueryBible($message);

        if ($data['status']){
            $scriptureData = $this->getScriptureData($data['data']);
            $scriptures = $this->tramsforResponse($scriptureData);
            return $scriptures;
        }else{
            return $this->errorMessage;
        }
    }

    private function prepareDataForQueryBible($message){
        // return ['chineses'=>'創', 'chap' => '1', 'sec' => '1']
        $query = explode(',',substr($message, 10));
        if (count($query) != 3){
            return ['status'=> false];
        }
        array_push($query,0);

        return [
            'status'=> true,
            'data'  => array_combine(['chineses','chap','sec','gb'],$query)
        ];
    }

    private function getScriptureData($data){

        $response = $this->client->request(
            'GET',
            'http://bible.fhl.net/json/qb.php',
            ['query'=> $data]
        );

        $scripture = json_decode($response->getBody());
        return $scripture;
    }

    private function tramsforResponse($data){
        $scriptures = '';

        foreach ($data->record as $record) {
            $scriptures .= $record->bible_text;
        }

        return $scriptures;
    }
}
