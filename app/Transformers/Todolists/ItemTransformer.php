<?php


namespace App\Transformers\Todolists;


use App\Entities\Todolists\ItemData;
use App\Transformers\Transformer;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ItemTransformer extends Transformer
{

    /**
     * Transform an item.
     *
     *
     * @param Request $item
     *
     * @return mixed
     */
    public function transform($item)
    {
        $data = new ItemData();

        $data->name = $item->input('name');
        $data->displayAfter = $this->getDate($item);

        return $data;

    }

    private function getDate(Request $request): ?Carbon
    {
        if($request->filled('date'))
        {
            $date = $request->input('date');
            $time = $request->input('hour') . ':' . $request->input('min') . ":00";

            return Carbon::parse($date . " " . $time);
        }

        return null;
    }
}