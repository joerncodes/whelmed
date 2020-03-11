<?php

namespace App\Faker\Provider;

use Faker\Provider\Base as BaseProvider;

class TagProvider extends BaseProvider
{
    const TAGS = [
        'E-Mail',
        'Person',
        'Waiting for',
        'Plane',
        'Car',
        'Home',
        'Phone',
        'Forecast',
        'Friends',
        'Family',
    ];

    public function tag(): string
    {
        return self::unique()->randomElement(self::TAGS);
    }
}
