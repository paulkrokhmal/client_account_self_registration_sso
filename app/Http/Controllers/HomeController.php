<?php

namespace App\Http\Controllers;

use App\Facades\IpstackFacade;
use App\Facades\OpenWeatherFacade;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        // '91.213.59.194'
        $ipData = IpstackFacade::getIpData($request->ip());
        $address = "{$ipData['city']}, {$ipData['country_code']}}";

        $weatherData = OpenWeatherFacade::getWeather($address);

        $data = [
          'user' => new UserResource(auth()->user()),
            'main' => $weatherData['main'] ?? null,
        ];

        return view('home', compact('data'));
    }
}
