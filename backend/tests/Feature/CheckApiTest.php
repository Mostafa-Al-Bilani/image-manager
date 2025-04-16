<?php

namespace Tests\Feature;

use Tests\TestCase;

class CheckApiTest extends TestCase
{
    public function test_api_routes_are_loaded()
    {
        $response = $this->get('/api/test-api');
        $response->assertStatus(200);
    }
}
