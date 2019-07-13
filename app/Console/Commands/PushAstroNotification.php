<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\CrawlerService;
use App\Services\LineBotService;

class PushAstroNotification extends Command
{
    private $path;

    private $crawlerService;

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
    public function __construct(CrawlerService $crawlerService)
    {
        parent::__construct();
        $this->path = config('services.url.astro');
        $this->crawlerService = $crawlerService;
        $this->lineBotService = new LineBotService(env('LINE_USER_ID'));
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $originalData = $this->crawlerService->getOriginalData($this->path);
        $message = $this->crawlerService->getNewAstroFromYahoo($originalData);

        $this->lineBotService->pushMessage($message);
    }
}
