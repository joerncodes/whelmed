<?php

namespace App\Faker\Provider;

use Faker\Provider\Base as BaseProvider;

class ProjectProvider extends BaseProvider
{
    const PROJECTS = [
        'Clean the garage',
        'Move',
        'Get a new job',
        'Find fulfillment in live',
        'Book vacation',
        'Form a band',
    ];

    public function project(): string
    {
        return self::unique()->randomElement(self::PROJECTS);
    }
}
