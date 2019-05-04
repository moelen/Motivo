<?php

namespace App\Entities\Todolists;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

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


}
