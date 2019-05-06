<?php

namespace App\Entities\Attachments;

use App\Entities\Todolists\Item;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Attachment
 * @package App\Entities\Attachments
 *
 * @property int    $id
 * @property string $name
 * @property string $path
 * @property string $fullPath
 * @property Item   $item
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Attachment extends Model
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'attachments';

    /**
     * @return BelongsTo
     */
    public function item(): BelongsTo
    {
        return $this->belongsTo(Item::class);
    }

    /**
     * @return string
     */
    public function getFullPathAttribute(): string
    {
        return storage_path('app' . DIRECTORY_SEPARATOR . $this->path);
    }
}
