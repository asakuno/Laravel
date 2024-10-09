<?php

declare(strict_types=1);

namespace App\Http\Controllers\Estate;

use App\Http\Controllers\Controller;
use App\Http\Requests\Estate\SearchEstateRequest;
use App\UseCases\Estate\SearchEstateUseCase;
use Illuminate\Http\JsonResponse;

class SearchEstateController extends Controller
{
    public function __construct(
        private readonly SearchEstateUseCase $searchEstateUseCase,
    ){
    }

    public function __invoke(SearchEstateRequest $request): JsonResponse
    {
        return $this->searchEstateUseCase->execute($request->getSearchData());
    }
}
