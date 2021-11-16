<?php

namespace Tests\Unit;

use App\Facades\OpenWeatherFacade;
use Tests\TestCase;

class OpenWeatherTest extends TestCase
{
    /** @test */
    public function test_1()
    {
        $data = OpenWeatherFacade::getWeather('Kiev');
        $this->assertNotNull($data);
    }
}
