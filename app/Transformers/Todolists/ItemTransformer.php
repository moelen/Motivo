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
        $data->labels = $this->getLabels($item);
        $data->files = $item->attachments ?? [];

        return $data;

    }

    /**
     * @param Request $request
     *
     * @return Carbon|null
     */
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

    /**
     * @param Request $request
     *
     * @return array
     */
    private function getLabels(Request $request): array
    {
        return collect(explode(',', $request->input('labels', [])))->map(function (string $item) {
            return strtolower(trim($item));
        })
            ->reject(function ($item) {
                return is_null($item) || $item === "";
            })
            ->toArray();
    }
}