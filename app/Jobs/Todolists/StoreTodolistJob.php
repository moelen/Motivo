<?php

namespace App\Jobs\Todolists;

use App\Entities\Todolists\TodoList;
use App\Http\Requests\Todolist\StoreTodolistRequest;

class StoreTodolistJob
{

    /**
     * @var StoreTodolistRequest
     */
    private $request;

    /**
     * Create a new job instance.
     *
     * @param StoreTodolistRequest $request
     */
    public function __construct(StoreTodolistRequest $request)
    {
        $this->request = $request;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $todo = new TodoList();
        $todo->name = $this->request->input('name');

        $todo->save();
    }
}
