<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\CrawlerService;
use App\Services\AstroService;
use App\Services\LineBotService;

class PushAstroNotification extends Command
{
    private $astro;

    private $lineBotService;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'line:Astro';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(AstroService $astroService)
    {
        parent::__construct();
        $this->astro = $astroService;
        $this->lineBotService = new LineBotService();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $message = $this->astro->getDailyAstro('今日運勢');

        $this->lineBotService->pushMessage(env('LINE_USER_ID'), $message);
    }
}
