<?php

namespace App\Services;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class OpenWeatherService {
    //api.openweathermap.org/data/2.5/weather?q={city name},{state code},{country code}&appid={API key}

    private $API_URL = 'https://api.openweathermap.org/data/2.5/weather';
    private $API_KEY;

    public function __construct(string $API_KEY)
    {
        $this->API_KEY = $API_KEY;
    }

    public function getWeather($address)
    {
        $cachedWeather = Cache::store('redis')->tags(['open_weather'])->get($address);

        if ($cachedWeather) {
            return $cachedWeather;
        }

        $response = Http::post("{$this->API_URL}?q={$address}&appid={$this->API_KEY}");

        $parsedData = $response->json();

        if ($parsedData['cod'] === 200) {
            return Cache::store('redis')->tags(['open_weather'])->rememberForever($address,
                function () use ($parsedData) {
                    return Arr::only($parsedData, ['weather', 'main', 'visibility', 'wind', 'clouds']);
                });
        }

        return null;
    }

}
