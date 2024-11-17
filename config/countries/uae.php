<?php

return [
    'fields' => [
        'address_line_1' => 'address.address_line_1',
        'address_line_2'=> 'address.address_line_2',
        'city' => 'address.city',
        'state' => 'address.state',

        'country' => 'address.country'
    ],
    'rules' => [

        'address_line_1' => 'required|string|max:255',
        'address_line_2' => 'nullable|string|max:255',
        'city' => 'required|string|max:255',

        'state' => 'required|string|max:255',
        'country' => 'required',
    ]
];
