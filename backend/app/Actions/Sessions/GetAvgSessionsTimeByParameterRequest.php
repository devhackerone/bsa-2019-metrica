<?php

declare(strict_types=1);

namespace App\Actions\Sessions;

use App\Actions\TableDataRequest;
use App\Http\Requests\Api\GetAvgSessionsTimeByParameterHttpRequest;

final class GetAvgSessionsTimeByParameterRequest extends TableDataRequest
{
    public static function fromRequest(GetAvgSessionsTimeByParameterHttpRequest $request): self
    {
        return new static(
            $request->startDate(),
            $request->endDate(),
            $request->parameter()
        );
    }
}