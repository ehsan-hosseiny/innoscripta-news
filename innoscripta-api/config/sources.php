<?php

return [

    'list' => [
        'news_api',
        'ny_times',
        'guardians',
    ],

    'news_api' => [
        'key' => env('NEWS_API_KEY'),
    ],

    'guardian_api' => [
        'key' => env('GUARDIAN_API_KEY')
    ],

    'nyt_api' => [
        'key' => env('NYT_API_KEY'),
        'secret' => env('NYT_API_SECRET')
    ]


];
