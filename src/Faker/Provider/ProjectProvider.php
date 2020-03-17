<?php

namespace App\Faker\Provider;

use Faker\Provider\Base as BaseProvider;

class ProjectProvider extends BaseProvider
{
    const PROJECTS = [
        'Win the battle of the bands',
        'Defeat the 7 Evil Exes',
        'Write a new song',
        'Get new apartment',
    ];

    public function project(): string
    {
        return self::unique()->randomElement(self::PROJECTS);
    }
}
