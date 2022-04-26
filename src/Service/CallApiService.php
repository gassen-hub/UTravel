<?php

namespace App\Service;

use DateTime;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class CallApiService
{
    private $client;
public function __construct(HttpClientInterface $client)
{
    $this->client= $client;
}
public function getData () : array 
{
    $response = $this->client->request(
        'GET',
        'https://api.covid19api.com/summary' 
    );

    return $response->toArray();
}


   
}
