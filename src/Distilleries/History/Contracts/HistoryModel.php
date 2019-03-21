<?php

namespace Distilleries\History\Contracts;

use Illuminate\Database\Eloquent\Relations\MorphTo;

/**
 * Interface HistoryModel
 *
 * @package Distilleries\History\Contracts
 */
interface HistoryModel
{
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

    /**
     * The associated model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function model(): MorphTo;

    /**
     * The event author.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function author(): MorphTo;
}
