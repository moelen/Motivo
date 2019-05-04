<?php

namespace App\Jobs\Todolists;

use App\Entities\Todolists\Item;
use App\Entities\Todolists\TodoList;
use App\Http\Requests\Todolist\StoreItemRequest;

class StoreItemJob
{

    /**
     * @var StoreItemRequest
     */
    private $request;

    /**
     * @var TodoList
     */
    private $todoList;

    /**
     * Create a new job instance.
     *
     * @param StoreItemRequest $request
     * @param TodoList $todoList
     */
    public function __construct(StoreItemRequest $request, TodoList $todoList)
    {
        $this->request = $request;
        $this->todoList = $todoList;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $item = new Item();

        $item->name = $this->request->input('name');
        $item->todoList()->associate($this->todoList);

        $item->save();
    }
}
