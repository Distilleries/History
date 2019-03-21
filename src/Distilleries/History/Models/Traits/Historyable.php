<?php

namespace Distilleries\History\Models\Traits;

use Illuminate\Database\Eloquent\Relations\MorphTo;

/**
 * Trait Historyable
 *
 * @package Distilleries\History\Models\Traits
 * @property integer        $id
 * @property string         $type
 * @property integer        $model_id
 * @property string         $model_type
 * @property integer        $author_id
 * @property string         $author_type
 * @property array          $model_changes
 */
trait Historyable
{
    /**
     * {@inheritdoc}
     */
    public function model(): MorphTo
    {
        return $this->morphTo('model');
    }

    /**
     * {@inheritdoc}
     */
    public function author(): MorphTo
    {
        return $this->morphTo('author');
    }
}
