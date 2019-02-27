<?php

namespace Distilleries\History\Models\Traits;

use Distilleries\History\Observers\HistoryObserver;

trait ManageHistory
{
    public static function bootManageHistory(): void
    {
        static::observe(HistoryObserver::class);
    }
}
