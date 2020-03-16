<?php

namespace App\Faker\Provider;

use Faker\Provider\Base as BaseProvider;

class TaskProvider extends BaseProvider
{
    const TASKS = [
        'Make garlic bread',
        'Find out if chicken is vegan',
        'Create rock\'n\'roll ape monster',
        'Break up with Knives',
        'Find Roxy\'s \'Weak Point\'',
        'Go to the record store',
        'Tell a bunch of lies to my girlfriend',
        'We have to play NOW and LOUD',
        'Get a haircut',
        'Maybe don\'t get a haircut?',
        'Tell Ramona about PacMan',
        'Leave Ramona alone forever now',
        'Learn the bassline from Final Fantasy',
        'Find a better title for \'Launchpad McQuack\'',
        'Write a song about Ramona',
        'Gain the power of love',
        'Gain the power of self-respect',
        'Schedule a night\'s out with Nega-Scott',
        'Wait for my Amazon package',
        'Read the boring e-mail',
    ];

    public function task(): string
    {
        return self::unique()->randomElement(self::TASKS);
    }
}
