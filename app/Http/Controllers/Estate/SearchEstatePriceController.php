<?php

declare(strict_types=1);

namespace App\Http\Controllers\Estate;

use App\Http\Controllers\Controller;
use App\Http\Requests\Estate\SearchEstatePriceRequest;
use App\UseCases\Estate\SearchEstatePriceUseCase;
use Illuminate\Http\JsonResponse;

class SearchEstatePriceController extends Controller
{
    public function __construct(
        private readonly SearchEstatePriceUseCase $searchEstatePriceUseCase,
    ){
    }

    public function __invoke(SearchEstatePriceRequest $request): JsonResponse
    {
        return $this->searchEstatePriceUseCase->execute($request->getSearchPriceData());
    }
}
