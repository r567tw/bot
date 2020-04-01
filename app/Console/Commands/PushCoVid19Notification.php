<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\Features\Cov19Service;
use App\Services\LineBotService;

class PushCoVid19Notification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'line:coVid19';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';
    private $service;
    private $lineBotService;
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(Cov19Service $service)
    {
        parent::__construct();
        $this->service = $service;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->lineBotService = new LineBotService();

        $cov19Report = $this->service->getCov19Data();
        $this->lineBotService->pushMessage(env('LINE_USER_ID'), $cov19Report);
    }
}
