<?php

namespace App\Services;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class IpstackService {
    //http://api.ipstack.com/{ip}?access_key={api key}

    private $API_URL = 'http://api.ipstack.com';
    private $API_KEY;

    public function __construct(string $API_KEY)
    {
        $this->API_KEY = $API_KEY;
    }

    public function getIpData(string $ip) {
        $response = Http::get("{$this->API_URL}/{$ip}?access_key={$this->API_KEY}");

        if ($response->ok()) {
            return $response->json();
        }

        return null;
    }
}
