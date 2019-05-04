<?php

namespace App\Entities\Todolists;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class TodoList
 * @package App\Entities\Todolists
 *
 * @property int      $id
 * @property string   $name
 * @property TodoList $todoList
 * @property Carbon   $created_at
 * @property Carbon   $updated_at
 */
class Item extends Model
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'todo_list_items';

    /**
     * @return BelongsTo
     */
    public function todoList(): BelongsTo
    {
        return $this->belongsTo(TodoList::class);
    }
}
