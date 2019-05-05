<?php

namespace App\Jobs\Todolists;

use App\Entities\Todolists\Item;
use App\Entities\Todolists\ItemData;
use App\Entities\Todolists\TodoList;

class StoreItemJob
{

    /**
     * @var TodoList
     */
    private $todoList;

    /**
     * @var ItemData
     */
    private $data;

    /**
     * Create a new job instance.
     *
     * @param ItemData $data
     * @param TodoList $todoList
     */
    public function __construct(ItemData $data, TodoList $todoList)
    {
        $this->todoList = $todoList;
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $item = new Item();

        $item->todoList()->associate($this->todoList);

        $item->name = $this->data->name;
        $item->display_after = $this->data->displayAfter;

        $item->save();
    }
}
