<?php

namespace App\Services;

use App\Interfaces\NewsApiInterface;
use InvalidArgumentException;

class NewsApiFactory
{
    public static function createApi(string $type): NewsApiInterface
    {
        switch ($type) {
            case 'news_api':
                return new NewsApiAdapter();
            case 'ny_times':
                return new NyTimesApiAdapter();
            case 'guardians':
                return new GuardianApiAdapter();
            default:
                throw new InvalidArgumentException('Invalid API type.');
        }
    }

}
