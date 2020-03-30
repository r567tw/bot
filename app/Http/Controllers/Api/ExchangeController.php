<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Config;

class ExchangeController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth:api');
        //$this->middleware('isAdmin')->only(['edit','update','destroy']);
    }

    public function getList()
    {
        return response()->json(['symbols'=>Config::get('exchange.options')]);
    }

}
