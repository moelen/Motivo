<?php

namespace App\Entities\Todolists;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;

/**
 * Class TodoList
 * @package App\Entities\Todolists
 *
 * @property int               $id
 * @property string            $name
 * @property Collection|Item[] $items
 * @property Collection|Item[] $activeItems
 * @property Collection|Item[] $snoozedItems
 * @property Carbon            $created_at
 * @property Carbon            $updated_at
 */
class TodoList extends Model
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'todo_lists';

    /**
     * @return HasMany
     */
    public function items(): HasMany
    {
        return $this->hasMany(Item::class);
    }

    /**
     * @return HasMany
     */
    public function activeItems(): HasMany
    {
       return $this->items()
                   ->where(function (Builder $query) {
                       $query->orWhereNull('todo_list_items.display_after')
                             ->orWhere('todo_list_items.display_after', '<', Carbon::now()->format('Y-m-d h:m:i'));
                   });
    }

    /**
     * @return HasMany
     */
    public function snoozedItems(): HasMany
    {
        return $this->items()
            ->whereNotNull('todo_list_items.display_after')
            ->where('todo_list_items.display_after', '>', Carbon::now()->format('Y-m-d h:m:i'));
    }
}
