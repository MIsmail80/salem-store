<?php

return [
    'egyptshipping' => [
        'code' => 'egyptshipping',
        'title' => 'Egypt Shipping',
        'description' => 'Shipping rates based on Egyptian governorate',
        'active' => true,
        'default_rate' => '50',
        'type' => 'per_order',
        'class' => 'Webkul\\EgyptShipping\\Carriers\\EgyptShipping',
    ],
];
