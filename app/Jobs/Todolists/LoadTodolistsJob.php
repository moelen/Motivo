<?php

namespace App\Jobs\Todolists;

use App\Entities\Todolists\TodoList;
use Illuminate\Database\Eloquent\Collection;

class LoadTodolistsJob
{

    /**
     * Execute the job.
     *
     * @return Collection
     */
    public function handle()
    {
        return TodoList::select('todo_lists.*')
                         ->orderBy('todo_lists.created_at', 'DESC')
                         ->get();
    }
}
