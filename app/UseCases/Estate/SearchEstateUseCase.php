<?php

declare(strict_types=1);

namespace App\UseCases\Estate;

use App\DataTransferObjects\Estate\SearchEstateData;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class SearchEstateUseCase
{
    /**
     * @param SearchEstateData $searchParams
     * @return JsonResponse
     */
    public function execute(SearchEstateData $searchParams): JsonResponse
    {
        $client = new Client();

        $responseArray = $this->getEstateInformation($client, $searchParams);

        return response()->json($responseArray);
    }

    /**
     * getEstateInformation
     *
     * @param  Client $client
     * @param  SearchEstateData $searchParams
     *
     * @throws GuzzleException
     *
     * @return array
     */
    private function getEstateInformation(Client $client, SearchEstateData $searchParams): array
    {
        try {
            $response = $client->get(config('estate.url'), [
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

            return json_decode($body, true);

        } catch(GuzzleException $e) {
            Log::error($e->getMessage());

            throw new GuzzleException();
        }
    }
}
