<?php

namespace Distilleries\History\Observers;

use Distilleries\History\Contracts\HistoryModel;
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
            'type'          => $event,
            'model_id'      => $model->getKey(),
            'model_type'    => get_class($model),
            'model_changes' => $this->getModelsChanges($event, $model),
        ];

        $author = request()->user();

        if (!empty($author)) {
            $data = array_merge($data, [
                'author_id'   => $author->getKey(),
                'author_type' => get_class($author),
            ]);
        }

        /** @var \Illuminate\Database\Eloquent\Model $history */
        $history = config('history.model');
        $history = new $history;

        if (! ($history instanceof HistoryModel)) {
            throw new \RuntimeException(config('history.model') . ' should be instance of ' . get_class(HistoryModel::class));
        }

        $history->fill($data);
        $history->save();
    }

    protected function getModelsChanges(string $event, Model $model): ?array
    {
        if (! in_array($event, config('history.log', [])) || ! $model->isDirty()) {
            return null;
        }

        $old = $model->getOriginal();
        $hidden = $model->getHidden();

        return collect($model->getDirty($model->getVisible()))
            ->filter(function ($value, $attribute) use ($hidden) {
                return ! in_array($attribute, $hidden);
            })
            ->mapWithKeys(function ($value, $attribute) use ($old) {
                return [
                    $attribute => [
                        'old' => data_get($old, $attribute),
                        'new' => $value,
                    ],
                ];
            })
            ->toArray();
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
