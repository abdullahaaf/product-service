<?php

return [
    'validateCategory' => [
        'name' => 'required',
        'enable' => 'required'
    ],
    'validateImage' => [
        'name' => 'required',
        'file' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
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
