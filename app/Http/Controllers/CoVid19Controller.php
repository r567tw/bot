<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Features\CoVid19Service;

class CoVid19Controller extends Controller
{

    private $area = ["台東縣"=> 0,"宜蘭縣"=> 0,"花蓮縣"=> 0,"澎湖縣"=> 0,"金門縣"=> 0,"連江縣"=> 0,"台北市"=> 0,"新北市"=> 0,"桃園市"=> 0,"台中市"=> 0,"台南市"=> 0,"高雄市"=> 0,"基隆市"=> 0,"新竹縣"=> 0,"新竹市"=> 0,"苗栗縣"=> 0,"彰化縣"=> 0,"南投縣"=> 0,"雲林縣"=> 0,"嘉義縣"=>0,"嘉義市"=> 0,"屏東縣"=> 0];

    public function __construct(CoVid19Service $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        return view('CoVid19.index');
    }

    public function getResultByArea()
    {
        $data = collect($this->service->getApiData());
        $result = $data->groupBy('縣市')->map(function($item){
            return $item->sum('確定病例數');
        });
        $result = collect($this->area)->merge($result)->sort()->reverse();
        return view('CoVid19.area')->with('result',$result);
    }

    public function getResultByAge()
    {
        $data = collect($this->service->getApiData());
        $result = $data->groupBy('年齡層')->map(function($item){
            return $item->sum('確定病例數');
        })->sort()->reverse();
        return view('CoVid19.age')->with('result',$result);
    }

    public function getResultByGender()
    {
        $gender = ['F'=>'女性','M'=>'男性'];
        $data = collect($this->service->getApiData());
        $result = $data->groupBy('性別')->map(function($item){
            return $item->sum('確定病例數');
        })->sort()->reverse();
        return view('CoVid19.gender')->with('result',$result)->with('gender',$gender);
    }

    public function getResultByForeign()
    {
        $data = collect($this->service->getApiData());
        $result = $data->groupBy('是否為境外移入')->map(function($item){
            return $item->sum('確定病例數');
        })->sort()->reverse();
        return view('CoVid19.foreign')->with('result',$result);
    }
    
}
