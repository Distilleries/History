<?php

namespace Distilleries\History\Observers;

use Distilleries\History\Models\History;
use Illuminate\Database\Eloquent\Model;

class HistoryObserver
{
    protected function storeEvent(string $event, Model $model)
    {
        if (! in_array($event, config('history.events', []))) {
            return;
        }

        $data = [
            'type'       => $event,
            'model_id'   => $model->getKey(),
            'model_type' => get_class($model),
        ];

        $author = request()->user();

        if (!empty($author)) {
            $data = array_merge($data, [
                'author_id'   => $author->getKey(),
                'author_type' => get_class($author),
            ]);
        }

        History::create($data);
    }

    public function retrieved(Model $model)
    {
        $this->storeEvent(History::EVENT_RETRIEVED, $model);
    }

    public function creating(Model $model)
    {
        $this->storeEvent(History::EVENT_CREATING, $model);
    }

    public function created(Model $model)
    {
        $this->storeEvent(History::EVENT_CREATED, $model);
    }

    public function updating(Model $model)
    {
        $this->storeEvent(History::EVENT_UPDATING, $model);
    }

    public function updated(Model $model)
    {
        $this->storeEvent(History::EVENT_UPDATED, $model);
    }

    public function saving(Model $model)
    {
        $this->storeEvent(History::EVENT_SAVING, $model);
    }

    public function saved(Model $model)
    {
        $this->storeEvent(History::EVENT_SAVED, $model);
    }

    public function deleting(Model $model)
    {
        $this->storeEvent(History::EVENT_DELETING, $model);
    }

    public function deleted(Model $model)
    {
        $this->storeEvent(History::EVENT_DELETED, $model);
    }

    public function forceDeleted(Model $model)
    {
        $this->storeEvent(History::EVENT_FORCE_DELETED, $model);
    }

    public function restoring(Model $model)
    {
        $this->storeEvent(History::EVENT_RESTORING, $model);
    }

    public function restored(Model $model)
    {
        $this->storeEvent(History::EVENT_RESTORED, $model);
    }
}
