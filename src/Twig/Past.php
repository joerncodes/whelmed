<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class Past extends AbstractExtension
{
    public function getFilters(): array
    {
        return [
            new TwigFilter('past', [$this, 'checkPast'])
        ];
    }

    public function checkPast(\DateTimeInterface $dateTime): bool
    {
        $now = new \DateTime();

        return $now->getTimestamp() > $dateTime->getTimestamp();
    }
}
