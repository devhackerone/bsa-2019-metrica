<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Actions\Sessions\GetAllSessionsAction;
use App\Http\Controllers\Controller;
use App\Http\Resources\SessionResourceCollection;
use App\Http\Response\ApiResponse;
use App\Http\Requests\SessionHttpRequest;

final class SessionController extends Controller
{
    private $getAllSessionsAction;

    public function __construct(GetAllSessionsAction $getAllSessionsAction)
    {
        $this->getAllSessionsAction = $getAllSessionsAction;
    }

    public function getAllSessions(): ApiResponse
    {
        $response = $this->getAllSessionsAction->execute();

        return ApiResponse::success(new SessionResourceCollection($response->sessions()));
    }
}
