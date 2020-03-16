<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class WhelmedDate extends AbstractExtension
{
    public function getFilters(): array
    {
        return [
            new TwigFilter('whelmeddate', [$this, 'formatDate'])
        ];
    }

    public function formatDate(\DateTimeInterface $dateTime, $addTime = false): string
    {
        if($addTime) {
            return $dateTime->format('Y-m-d H:i:s');
        }
        return $dateTime->format('Y-m-d');
    }
}
