<?php

declare(strict_types=1);

namespace App\Actions\Sessions;

final class GetAvgSessionResponse
{
    private $avgSession;

    public function __construct(int $avgSession)
    {
        $this->avgSession = $avgSession;
    }

    public function avgSession(): int
    {
        return (int) $this->avgSession;
    }
}