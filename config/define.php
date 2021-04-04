<?php

return [
    'order' => [
        'status' => [
            'pending' => 0,
            'accept' => 1,
            'reject' => 2,
            'borrowed' => 3,
            'close' => 4,
            'cancel' => 5,
        ],
    ],
    'car' => [
        'status' => [
            'pending' => 0,
            'reject' => 1,
            'accept' => 2,
            'renting' => 3,
            'block' => 4,
        ]
    ],
];