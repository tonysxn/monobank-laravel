<?php

namespace Neverlxsss\Monobank\Support;

use GuzzleHttp\Exception\GuzzleException;
use Mockery\Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use Neverlxsss\Monobank\Support\Method;

class Monobank
{
    private string $token;
    private string $apiUrl;


    public function __construct(string $token, string $apiUrl = "https://api.monobank.ua")
    {
        if (empty($token)) {
            throw new Exception("Token is required");
        }

        if (empty($apiUrl)) {
            throw new Exception("API endpoint is required");
        }

        $this->token = $token;
        $this->apiUrl = $apiUrl;
    }

    /**
     * Call api
     *
     */
    public function api(
        string $path,
        string $method,
        array  $headers = [],
        array  $params = [],
        int    $timeout = 5,
    ): Response
    {
        $suits = array_column(Method::cases(), "value");
        // Validate request method
        if (!in_array($method, $suits)) {
            throw new Exception("Invalid method");
        }

        // Append api token to headers
        $headers['X-Token'] = $this->token;
        // Set application-json for encoded body
        $headers['content-type'] = "application/json";

        // Fill query and body
        if ($method == Method::POST->value) {
            $body = array_filter($params);
        } elseif ($method == Method::GET->value) {
            $body = [];
            if (!empty($params)) {
                $headers['query'] = $params;
            }
        } else {
            $body = $params;
        }

        // Encode body to json
        $body = json_encode($body);

        $client = new Client(['base_uri' => $this->apiUrl, 'timeout' => $timeout]);

        try {
            $response = $client->request($method, $path, [
                'headers' => $headers,
                'query' => $method == Method::GET->value ? $params : null,
                'body' => $method == Method::POST->value ? $body : null,
            ]);
        } catch (GuzzleException $e) {
            return new Response(null, null, $e->getMessage());
        }

        return new Response(
            $response->getStatusCode(),
            json_decode($response->getBody()->getContents())
        );
    }
}
