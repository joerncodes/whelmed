<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class WhelmedDate extends AbstractExtension
{
    public function getFilters()
    {
        return [
            new TwigFilter('whelmeddate', [$this, 'formatDate'])
        ];
    }

    public function formatDate(\DateTimeInterface $dateTime) {
        return $dateTime->format('Y-m-d');
    }
}
