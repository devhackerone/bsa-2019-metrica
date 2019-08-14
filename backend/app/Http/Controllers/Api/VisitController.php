<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Actions\Visits\GetPageViewsAction;
use App\Http\Controllers\Controller;
use App\Http\Resources\VisitResource;
use App\Http\Response\ApiResponse;

final class VisitController extends Controller
{
    private $getPageViewsAction;

    public function __construct(GetPageViewsAction $getPageViewsAction)
    {
        $this->getPageViewsAction = $getPageViewsAction;
    }

    public function getPageViews(): ApiResponse
    {
        $response = $this->getPageViewsAction->execute();

        return ApiResponse::success(new VisitResource($response->views()));
    }
}