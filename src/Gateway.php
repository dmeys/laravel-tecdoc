<?php

namespace Composite\TecDoc;

use Exception;
use GuzzleHttp\Client;
use InvalidArgumentException;

class Gateway
{
    /**
     * @var string
     */
    private $apiKey;

    /**
     * @var \GuzzleHttp\Client
     */
    protected $client;

    /**
     * @param  string|null  $publicKey
     * @param  string|null  $privateKey
     *
     * @throws \InvalidArgumentException
     */
    public function __construct(?string $service_url, ?string $apiKey)
    {
        // if (!$apiKey) {
        //     throw new InvalidArgumentException('API key is missing');
        // }
        $this->apiKey = $apiKey;
        
        $this->client = new Client([
            'base_uri' => $service_url,
            'verify' => false,
            'debug' => false,
        ]);
    }

    /**
     * @param string $uri
     * @param array $payload
     * @return array
     * @throws Exception
     */
    public function get(string $uri, array $payload = []): array
    {
        return $this->request('GET', $uri, [
            'query' => $payload,
        ]);
    }

    /**
     * @param string $uri
     * @param array $payload
     * @return array
     * @throws Exception
     */
    public function post(string $uri, array $payload = []): array
    {
        return $this->request('POST', $uri, [
            'json' => $payload,
        ]);
    }

    /**
     * @param string $uri
     * @param array $payload
     * @return array
     * @throws Exception
     */
    public function put(string $uri, array $payload = []): array
    {
        return $this->request('PUT', $uri, [
            'json' => $payload,
        ]);
    }

    /**
     * @param string $uri
     * @param array $payload
     * @return array
     * @throws Exception
     */
    public function delete(string $uri, array $payload = []): array
    {
        return $this->request('DELETE', $uri, [
            'query' => $payload,
        ]);
    }

    /**
     * @param string $method
     * @param string $uri
     * @param array $payload
     * @return array
     * @throws Exception
     */
    protected function request(string $method, string $uri, array $payload = []): array
    {
        $defaultOptions = [
            'headers' => [
                'Accept' => 'application/json',
                'X-API-KEY' => $this->apiKey
            ],
        ];

        $response = $this->client->request($method, $uri, array_merge($defaultOptions, $payload));

        $responseBody = json_decode($response->getBody(), true);
        if ($responseBody["status"]) {
            if($responseBody["status"] !== 200){
                throw new Exception($responseBody["statusText"]);
            } /*else if(empty($responseBody["data"])){ //todo AIM: risk place. TecDoc doesn't have authentic response format
                throw new Exception("Empty response");
            }*/
        }
            
        return $responseBody;
    }
}