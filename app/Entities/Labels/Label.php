<?php


namespace App\Entities\Labels;


use App\Entities\Todolists\Item;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Class Label
 * @package App\Entities\Labels
 *
 * @property integer $id
 * @property string  $name
 * @property Carbon  $created_at
 * @property Carbon  $updated_at
 */
class Label extends Model
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'labels';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name'
    ];

    /**
     * @return BelongsToMany
     */
    public function listItems(): BelongsToMany
    {
        return $this->belongsToMany(Item::class, 'label_todo_list_item', 'label_id', 'todo_list_item_id');
    }
}