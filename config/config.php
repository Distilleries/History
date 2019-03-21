<?php

return [
    'model' => \Distilleries\History\Models\History::class,
    'events' => [
        'created', 'updated', 'deleted', 'restored',
    ],

    'log' => [
        'updated',
    ],
];
