<?php

namespace Distilleries\History\Models;

use Distilleries\History\Contracts\HistoryModel;
use Distilleries\History\Models\Traits\Historyable;
use Illuminate\Database\Eloquent\Model;

/**
 * Class History
 * @package Distilleries\History\Models
 * @property \Carbon\Carbon $created_at
 */
class History extends Model implements HistoryModel
{
    use Historyable;

    const UPDATED_AT = null;

    /**
     * {@inheritdoc}
     */
    protected $fillable = [
        'type',
        'model_id',
        'model_type',
        'author_id',
        'author_type',
        'model_changes',
    ];

    /**
     * {@inheritdoc}
     */
    protected $casts = [
        'model_changes' => 'array',
    ];
}
