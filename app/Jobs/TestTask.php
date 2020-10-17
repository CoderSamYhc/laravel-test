<?php


namespace App\Jobs;

use Hhxsv5\LaravelS\Swoole\Task\Task;
use Illuminate\Support\Facades\Log;

class TestTask extends Task
{
    private $data;

    private $result;
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * @inheritDoc
     */
    public function handle()
    {
        Log::info(__CLASS__ . ':开始处理任务', [$this->data]);
        sleep(1);
        $this->result = 'The result of ' . $this->data . ' is balabala';
    }

    public function finish()
    {
        Log::info(__CLASS__ . ':任务处理完成', [$this->result]);
    }
}
