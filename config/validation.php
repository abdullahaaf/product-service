<?php

return [
    'validateCategory' => [
        'name' => 'required',
        'enable' => 'required'
    ],
    'validateImage' => [
        'name' => 'required',
        'file' => 'required|image:jpeg,png,jpg,gif,svg|max:2048',
        'enable' => 'required'
    ]
];
