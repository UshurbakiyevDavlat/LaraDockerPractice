<?php

namespace App\Components;

use GuzzleHttp\Client;

class ImportDataClient
{
    public $client;

    public function __construct() {
        $this->client = new Client([
            'base_uri' => 'https://techcrunch.com/wp-json/wp/v2/',
            'timeout' => 2.0,
            'verify' => false
        ]);
    }
}
