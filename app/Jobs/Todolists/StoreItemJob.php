<?php

namespace App\Jobs\Todolists;

use App\Entities\Labels\Label;
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
        $item->order = 0;

        $item->save();

        $this->attachLabels($item);
    }

    /**
     * @param Item $item
     */
    private function attachLabels(Item $item)
    {
        foreach($this->data->labels as $labelName)
        {
            $label = $this->getLabel($labelName);

            $item->labels()->attach($label);
        }

        $item->save();
    }

    /**
     * @param string $name
     *
     * @return Label
     */
    private function getLabel(string $name): Label
    {
        return Label::firstOrCreate(['name' => $name]);
    }
}
