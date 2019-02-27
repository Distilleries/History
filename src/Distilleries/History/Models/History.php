<?php

namespace Distilleries\History\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

/**
 * Class History
 * @package Distilleries\History\Models
 * @property integer        $id
 * @property string         $type
 * @property integer        $model_id
 * @property string         $model_type
 * @property integer        $author_id
 * @property string         $author_type
 * @property \Carbon\Carbon $created_at
 */
class History extends Model
{
    const UPDATED_AT = null;

    const EVENT_RETRIEVED = 'retrieved';
    const EVENT_CREATING = 'creating';
    const EVENT_CREATED = 'created';
    const EVENT_UPDATING = 'updating';
    const EVENT_UPDATED = 'updated';
    const EVENT_SAVING = 'saving';
    const EVENT_SAVED = 'saved';
    const EVENT_RESTORING = 'restoring';
    const EVENT_RESTORED = 'restored';
    const EVENT_DELETING = 'deleting';
    const EVENT_DELETED = 'deleted';
    const EVENT_FORCE_DELETED = 'forceDeleted';

    protected $fillable = [
        'type',
        'model_id',
        'model_type',
        'author_id',
        'author_type',
    ];

    /**
     * The associated model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function model(): MorphTo
    {
        return $this->morphTo('model');
    }

    public function author(): MorphTo
    {
        return $this->morphTo('author');
    }
}
