<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function test()
    {
        for ($i = 0; $i <= 2; $i++) {
            $task = new \App\Jobs\TestTask('task-test' . $i);
            $success = \Hhxsv5\LaravelS\Swoole\Task\Task::deliver($task);
            dump('info', $success);
        }
    }
}
