<?php

namespace Tests\Models;

use Distilleries\History\Models\Traits\ManageHistory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use ManageHistory;

    protected $fillable = [
        'title',
        'password',
    ];

    protected $hidden = [
        'password',
    ];
}
