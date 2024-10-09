<?php

declare(strict_types=1);

namespace App\UseCases\Estate;

use App\DataTransferObjects\Estate\SearchEstatePriceData;
use App\Http\Resources\Estate\SearchEstatePriceResource;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class SearchEstatePriceUseCase
{
    /**
     * @param SearchEstatePriceData $searchParams
     * @return JsonResponse
     */
    public function execute(SearchEstatePriceData $searchParams): JsonResponse
    {
        $client = new Client();

        $responseArray = $this->getEstateInformation($client, $searchParams);

        // return response()->json($responseArray);

        return (new SearchEstatePriceResource($responseArray))->response();
    }

    /**
     * getEstateInformation
     *
     * @param  Client $client
     * @param  SearchEstatePriceData $searchParams
     *
     * @throws GuzzleException
     *
     * @return array
     */
    private function getEstateInformation(Client $client, SearchEstatePriceData $searchParams): array
    {
        // 処理同じなので基底クラス作りたい
        $logContext = [
            'method' => __METHOD__,
            'search_params' => $searchParams->toArray(),
        ];

        try {
            $response = $client->get(config('estate.estate_price_url'), [
                'headers' => [
                    'Ocp-Apim-Subscription-Key' => config('estate.api_key'),
                    'Accept' => 'application/json',
                ],
                'query' => [
                    'price_classification' => $searchParams->priceClassification,
                    'year' => $searchParams->year,
                    'quarter' => $searchParams->quarter,
                    'area' => $searchParams->area,
                    'city' => $searchParams->city,
                ]
            ]);
            $body = $response->getBody()->getContents();

            Log::info(array_merge($logContext, [
                'response_status' => $response->getStatusCode(),
                'response_size' => strlen($body),
            ]));

            return json_decode($body, true);

        } catch(GuzzleException $e) {
            Log::error('Failed to retrieve estate information', array_merge($logContext, [
                'error_message' => $e->getMessage(),
                'error_code' => $e->getCode(),
                'stack_trace' => $e->getTraceAsString(),
            ]));

            throw $e;
        }
    }
}
