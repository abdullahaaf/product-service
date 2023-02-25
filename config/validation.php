<?php

return [
    'validateCategory' => [
        'name' => 'required',
        'enable' => 'required'
    ],
    'validateImage' => [
        'name' => 'required',
        'file' => 'required',
        'enable' => 'required'
    ],
    'validateProduct' => [
        'name' => 'required',
        'description' => 'required',
        'enable' => 'required',
        'category' => 'required|integer',
        'image' => 'required|integer'
    ]
];
