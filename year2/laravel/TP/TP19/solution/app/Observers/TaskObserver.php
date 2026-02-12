<?php

namespace App\Observers;

use App\Models\Task;
use Illuminate\Support\Facades\Log;


class TaskObserver
{
    /**
     * Handle the Task "created" event.
     */
    public function created(Task $task): void
    {
        Log::info("task with id $task->id was created");
    }

    /**
     * Handle the Task "updated" event.
     */
    public function updated(Task $task): void
    {
        Log::info("task with id $task->id was updated");
    }

    /**
     * Handle the Task "deleted" event.
     */
    public function deleted(Task $task): void
    {
        Log::info("task with id $task->id was deleted");
    }

    /**
     * Handle the Task "restored" event.
     */
    public function restored(Task $task): void
    {
        Log::info("task with id $task->id was restored");
    }

    /**
     * Handle the Task "force deleted" event.
     */
    public function forceDeleted(Task $task): void
    {
        Log::info("task with id $task->id was deleted permanentaly");
    }
}
