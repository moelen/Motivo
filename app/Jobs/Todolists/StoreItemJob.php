<?php

namespace App\Jobs\Todolists;

use App\Entities\Attachments\Attachment;
use App\Entities\Labels\Label;
use App\Entities\Todolists\Item;
use App\Entities\Todolists\ItemData;
use App\Entities\Todolists\TodoList;
use Illuminate\Http\UploadedFile;

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
        $this->storeAttachments($item);
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

    /**
     * @param Item $item
     */
    private function storeAttachments(Item $item): void
    {
        /** @var $file UploadedFile */
        foreach($this->data->files as $file)
        {
            $dir = 'attachments';
            $fileName = $item->id . "_" . $file->hashName();

            $file->storeAs($dir, $fileName);

            $attachment = new Attachment();
            $attachment->item()->associate($item);
            $attachment->name = $file->getClientOriginalName();
            $attachment->path = $dir . DIRECTORY_SEPARATOR . $fileName;

            $attachment->save();
        }
    }
}
