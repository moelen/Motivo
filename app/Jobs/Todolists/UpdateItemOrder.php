<?php

namespace App\Jobs\Todolists;

use App\Entities\Todolists\Item;
use App\Entities\Todolists\ItemData;
use App\Entities\Todolists\TodoList;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class UpdateItemOrder
{

    /**
     * @var Request
     */
    private $request;

    /**
     * UpdateItemOrder constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
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
        $order = $this->request->input('items');
        $items = $this->getItems(array_keys($order));

        foreach ($items as $item)
        {
            $item->order = $order[$item->id] ?? 0;
            $item->save();
        }
    }

    /**
     * @param array $ids
     *
     * @return Collection
     */
    private function getItems(array $ids): Collection
    {
        return Item::select('todo_list_items.*')
                    ->whereIn('id', $ids)
                    ->get();
    }
}
