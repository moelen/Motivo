<?php

namespace App\Entities\Todolists;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class TodoList
 * @package App\Entities\Todolists
 *
 * @property int    $id
 * @property string $name
 * @property Carbon $created_at
 * @property Carbon $updated_at
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
}
