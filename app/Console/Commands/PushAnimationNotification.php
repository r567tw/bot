<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\CrawlerService;
use App\Services\LineBotService;

class PushAnimationNotification extends Command
{
    private $path;

    private $crawlerService;

    private $lineBotService;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pushline:animation';

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
        $this->path = config('services.url.baHa');
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
        $list = $this->crawlerService->getNewAnimationFromBaHa($originalData);

        $today = today()->format('m/d');
        $existedList = [];
        $list = array_map(function ($d) use ($today, &$existedList) {
            if (false === strpos($d['date'], $today) ||
                in_array($d['label'], $existedList, true)
            ) {
                return null;
            }
            $existedList[] = $d['label'];

            if (mb_strlen($d['label'], 'UTF-8') > 12) {
                $d['label'] = mb_substr($d['label'], 0, 9, 'UTF-8') . '...';
            }
            return $d;
        }, $list);

        $target = array_filter($list, function ($d) {
            return null !== $d;
        });

        $message = "{$today} 最新動畫來囉！";
        $messageBuilders = $this->lineBotService->buildImagesMessageBuilder($target, $message);

        foreach ($messageBuilders as $target) {
            $this->lineBotService->pushMessage($target);
        }

    }
}
