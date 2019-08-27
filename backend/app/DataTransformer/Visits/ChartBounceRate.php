<?php

declare(strict_types=1);

namespace App\DataTransformer\Visits;

use App\Contracts\ChartValue;

final class ChartBounceRate implements ChartValue
{
    private $period;
    private $count;

    public function __construct(string $period, string $count)
    {
        $this->period = $period;
        $this->count = $count;
    }

    public function date(): string
    {
        return $this->period;
    }

    public function value(): string
    {
        return $this->count;
    }
}