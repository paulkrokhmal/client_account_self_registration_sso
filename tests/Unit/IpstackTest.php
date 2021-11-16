<?php

namespace Tests\Unit;

use App\Facades\IpstackFacade;
use Tests\TestCase;

class IpstackTest extends TestCase {
    /** @test */
    public function test_1()
    {
        $data = IpstackFacade::getIpData('91.213.59.194');
        $this->assertNotNull($data);
    }
}
