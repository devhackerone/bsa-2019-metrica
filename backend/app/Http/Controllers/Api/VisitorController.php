<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Actions\Visitors\BounceRateAction;
use App\Actions\Visitors\BounceRateRequest;
use App\Actions\Visitors\GetAllVisitorsAction;
use App\Actions\Visitors\GetButtonCountVisitorsAction;
use App\Actions\Visitors\GetButtonCountVisitorsRequest;
use App\Actions\Visitors\GetNewestCountAction;
use App\Actions\Visitors\GetNewestCountRequest;
use App\Actions\Visitors\GetBounceRateAction;
use App\Actions\Visitors\GetBounceRateRequest;
use App\Actions\Visitors\GetNewVisitorsAction;
use App\Actions\Visitors\GetChartTotalVisitorsByDateRangeAction;
use App\Actions\Visitors\GetChartTotalVisitorsByDateRangeRequest;
use App\Http\Requests\Visitor\GetChartTotalVisitorsByDateRangeHttpRequest;
use App\Http\Resources\ChartResource;
use App\Http\Requests\Visitor\GetButtonCountVisitorsHttpRequest;
use App\Http\Requests\Visitor\GetNewChartVisitorsHttpRequest;
use App\Http\Requests\Visitor\GetNewVisitorCountFilterHttpRequest;
use App\Http\Resources\ButtonResource;
use App\Http\Requests\Visitor\GetVisitorsBounceRateHttpRequest;
use App\Http\Requests\Visitor\GetBounceRateHttpRequest;
use App\Http\Resources\BounceRateResource;
use App\Actions\Visitors\GetVisitorsByParameterAction;
use App\Actions\Visitors\GetVisitorsByParameterRequest;
use App\Http\Requests\Visitor\GetTableVisitorsByParameterHttpRequest;
use App\Http\Resources\VisitorResourceCollection;
use App\Http\Resources\TableVisitorsResourseCollection;
use App\Http\Response\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\ChartNewVisitorResourceCollection;
use App\Actions\Visitors\GetNewChartVisitorsByDateRangeAction;
use App\Actions\Visitors\GetNewChartVisitorsByDateRangeRequest;
use App\Actions\Visitors\GetNewVisitorsByParameterAction;
use App\Http\Resources\TableResource;
use App\Http\Requests\Api\GetTableNewVisitorsByParameterHttpRequest;
use App\Actions\Visitors\GetNewVisitorsByParameterRequest;
use App\Http\Resources\VisitorResource;

final class VisitorController extends Controller
{
    private $getAllVisitorsAction;
    private $getNewVisitorsAction;
    private $getNewVisitorsByDateRangeAction;
    private $getBounceRateAction;
    private $getButtonCountVisitorsAction;
    private $getVisitorsByParameterAction;
    private $getTotalVisitorsByDateRangeAction;
    private $getNewVisitorsByParameterAction;

    public function __construct(
        GetAllVisitorsAction $getAllVisitorsAction,
        GetNewVisitorsAction $getNewVisitorsAction,
        GetNewChartVisitorsByDateRangeAction $getNewVisitorsByDateRangeAction,
        GetBounceRateAction $getBounceRateAction,
        GetChartTotalVisitorsByDateRangeAction $getTotalVisitorsByDateRangeAction,
        GetButtonCountVisitorsAction $getButtonCountVisitorsAction,
        GetVisitorsByParameterAction $getVisitorsByParameterAction,
        GetNewVisitorsByParameterAction $getNewVisitorsByParameterAction
    ) {
        $this->getAllVisitorsAction = $getAllVisitorsAction;
        $this->getNewVisitorsAction = $getNewVisitorsAction;
        $this->getNewVisitorsByDateRangeAction = $getNewVisitorsByDateRangeAction;
        $this->getBounceRateAction = $getBounceRateAction;
        $this->getButtonCountVisitorsAction = $getButtonCountVisitorsAction;
        $this->getVisitorsByParameterAction = $getVisitorsByParameterAction;
        $this->getTotalVisitorsByDateRangeAction = $getTotalVisitorsByDateRangeAction;
        $this->getNewVisitorsByParameterAction = $getNewVisitorsByParameterAction;
    }

    public function getAllVisitors(): ApiResponse
    {
        $response = $this->getAllVisitorsAction->execute();

        return ApiResponse::success(new VisitorResourceCollection($response->visitors()));
    }

    public function getNewVisitors(): ApiResponse
    {
        $response = $this->getNewVisitorsAction->execute();

        return ApiResponse::success(new VisitorResourceCollection($response->visitors()));
    }

    public function getNewVisitorsCountForFilterData(GetNewVisitorCountFilterHttpRequest $request, GetNewestCountAction $action): ApiResponse
    {
        $response = $action->execute(GetNewestCountRequest::fromRequest($request));
        return ApiResponse::success(new ButtonResource($response));
    }

    public function getNewVisitorsByDateRange(GetNewChartVisitorsHttpRequest $request): ApiResponse
    {
        $response = $this->getNewVisitorsByDateRangeAction->execute(
            GetNewChartVisitorsByDateRangeRequest::fromRequest($request));

        return ApiResponse::success(new ChartNewVisitorResourceCollection($response->getVisitorsByDateRange()));
    }

    public function getVisitorsBounceRate(GetVisitorsBounceRateHttpRequest $request, BounceRateAction $action)
    {
        $response = $action->execute(BounceRateRequest::fromRequest($request));
        return ApiResponse::success(new ChartResource($response->getVisitorsBounceRateCollection()));
    }

    public function getBounceRate(GetBounceRateHttpRequest $request): ApiResponse
    {
        $response = $this->getBounceRateAction->execute(
            GetBounceRateRequest::fromRequest($request)
        );

        return ApiResponse::success(new ButtonResource($response));
    }

    public function getVisitorsByParameter(GetTableVisitorsByParameterHttpRequest $request): ApiResponse
    {
        $response = $this->getVisitorsByParameterAction->execute(
            GetVisitorsByParameterRequest::fromRequest($request)
        );

        return ApiResponse::success(new TableResource($response->visitors()));
    }

    public function getTotalVisitorsByDateRange(GetChartTotalVisitorsByDateRangeHttpRequest $request): ApiResponse
    {
        $response = $this->getTotalVisitorsByDateRangeAction->execute(
            GetChartTotalVisitorsByDateRangeRequest::fromRequest($request));

        return ApiResponse::success(new ChartResource($response->getTotalVisitorsByDateRange()));
    }

    public function getVisitorsCount(GetButtonCountVisitorsHttpRequest $request):ApiResponse
    {
        $response = $this->getButtonCountVisitorsAction->execute(GetButtonCountVisitorsRequest::fromRequest($request));
        return ApiResponse::success(new ButtonResource($response));
    }

    public function getNewVisitorsForTableByParameter(GetTableNewVisitorsByParameterHttpRequest $request): ApiResponse
    {
        $response = $this->getNewVisitorsByParameterAction->execute(
            GetNewVisitorsByParameterRequest::fromRequest($request));

        return ApiResponse::success(new TableResource($response->visitors()));
    }
}
