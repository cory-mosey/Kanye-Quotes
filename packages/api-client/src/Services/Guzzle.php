<?php

namespace AvrilloCodeTest\ApiClient\Services;

use AvrilloCodeTest\ApiClient\Interfaces\ApiClientDriver;
use AvrilloCodeTest\ApiClient\Services\ApiResponse;
use AvrilloCodeTest\ApiClient\Exceptions\ApiException;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response as GuzzleResponse;
use GuzzleHttp\Exception\BadResponseException;
use GuzzleHttp\Exception\ConnectException;

class Guzzle implements ApiClientDriver
{
    /**
     * @var ?Client
     */
    protected ?Client $client = null;

    /**
     * Establish the GuzzleHttp client.
     * 
     * @return Client
     */
    protected function client(): Client
    {
        if($this->client !== null) {
            return $this->client;
        }

        $this->client = new Client;
        return $this->client;
    }

    /**
     * Request through the client using the GET method.
     * 
     * @param string $url
     * @return ApiResponse
     * @throws ApiException
     */
    public function get(string $url): ApiResponse
    {
        try {
            $request = $this->client()->request('GET', $url);

            return $this->createResponse($request);
        } catch(BadResponseException $e) {
            throw new ApiException(
                $e->getResponse()->getReasonPhrase(),
                $e->getResponse()->getStatusCode()
            );
        } catch(ConnectException $e) {
            throw new ApiException("Could not resolve host");
        }
    }

    /**
     * Create the initialised requests for batching.
     * 
     * @param array $endpoints
     * @param string $method
     * @return \Generator
     */
    protected function createBatchRequests(array $endpoints, string $method): \Generator
    {
        foreach($endpoints as $endpoint) {
            yield fn() => $this->client()->{$method}($endpoint);
        }
    }

    /**
     * Batch GET requests and returned array of ApiResponse.
     * 
     * @param array $endpoints
     * @return array
     * @throws ApiException
     */
    public function batchGet(array $endpoints = []): array
    {
        $result = [];

        $pool = (
            new \GuzzleHttp\Pool(
                $this->client(),
                $this->createBatchRequests($endpoints, 'getAsync'),
                [
                    'concurrency' => 10,
                    'fulfilled' => function(GuzzleResponse $response) use(&$result) {
                        $result[] = $this->createResponse($response);
                    },
                    'rejected' => function (ConnectException|BadResponseException $e) {
                        if($e instanceof BadResponseException) {
                            throw new ApiException(
                                $e->getResponse()->getReasonPhrase(),
                                $e->getResponse()->getStatusCode()
                            );
                        }
                        if($e instanceof ConnectException) {
                            throw new ApiException("Could not resolve host");
                        }
                    },
                ]
            )
        )
        ->promise()
        ->wait();

        return $result;
    }

    /**
     * Create the response output using the supplied ApiResponse class.
     * 
     * @param GuzzleResponse $response
     * @return ApiResponse
     */
    public function createResponse(GuzzleResponse $response): ApiResponse
    {
        return (new ApiResponse)
            ->setStatusCode($response->getStatusCode())
            ->setHeaders($response->getHeaders())
            ->setBody(
                json_decode($response->getBody()->getContents())
            );
    }
}