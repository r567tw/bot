<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Features\Cov19Service;

class CoV19Controller extends Controller
{
    public function __construct(Cov19Service $service)
    {
        $this->service = $service;
    }

    public function getResult()
    {
        $data = collect($this->service->getApiData());
        $result = $data->groupBy('縣市')->map(function($item){
             return $item->sum('確定病例數');
        });
        $sum = $result->sum();
        return view('cov19')->with('result',$result);
    }

    
}
