<?php

namespace App\Faker\Provider;

use App\Domain\Constants\Icons;
use Faker\Provider\Base as BaseProvider;

class IconProvider extends BaseProvider
{
    public function icon(): string
    {
        return self::unique()->randomElement(Icons::ICONS);
    }
}
