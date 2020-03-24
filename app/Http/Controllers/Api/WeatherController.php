<?php

namespace App\Http\Controllers\Api;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Features\WeatherService;

class WeatherController extends Controller
{
    public function __construct(WeatherService $service)
    {
        $this->service = $service;
    }

    public function index($location)
    {
        $result = $this->service->getWeatherData($location);
        return response()->json($result);
    }
}
