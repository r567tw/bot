<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\WeatherService;
use App\Services\LineBotService;

class PushWeatherNotification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'line:weather';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';
    private $weather;
    private $lineBotService;
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(WeatherService $weather)
    {
        parent::__construct();
        $this->weather = $weather;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->lineBotService = new LineBotService();

        $weatherReport = $this->weather->getApiData('今日天氣:臺北市');
        $this->lineBotService->pushMessage(env('LINE_USER_ID'), $weatherReport);
    }
}
