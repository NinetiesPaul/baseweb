<?php

use GuzzleHttp\Client;
use PHPUnit\Framework\TestCase;

class EndpointTest extends TestCase
{
    public function testApiIsHealthy(): void
    {
        $client = new Client([ 'base_uri' => 'http://localhost:8080' ]);
    
        $response = $client->request('GET', '/health',);
        $response = json_decode($response->getBody(), true);

        $this->assertEquals([ 'success' => true, 'payload' => 'API is healthy!' ], $response);
    }
}
