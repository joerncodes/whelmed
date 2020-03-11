<?php

namespace App\Faker\Provider;

use Faker\Provider\Base as BaseProvider;

class TaskProvider extends BaseProvider
{
    const TASKS = [
        'Mow the lawn',
        'Clean the kitchen',
        'Achieve world domination',
        'Buy new shoes',
        'Clean the windows',
        'Apply for a new job',
        'Learn spanish',
        'Find a girlfriend',
        'Find a boyfriend',
        'Find a friend',
        'Summon the Elder God',
        'Join a cult',
        'Become a televangelist',
        'Insert myself unnecessarily in conversations not including me',
        'Meet Scarlett Johannson',
        'Learn Swedish',
        'Learn an unhealthy amount of Warhammer 40k lore',
        'Buy fake elven ears',
        'Bring the ring to Mount Doom',
        'Solve the riddle (what DOES it have in its pocket?)',
    ];

    public function task()
    {
        return self::randomElement(self::TASKS);
    }
}
