<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PositionTest extends TestCase
{

    /**
     * Test /api/positions/search without token
     *
     * @return void
     */
    public function test_positions_route_without_token()
    {
        $response = $this->get('/api/positions/search');

        $response->assertStatus(401);
    }

    /**
     * Test /api/positions/search list json format
     *
     * @return void
     */
    public function test_positions_index_json()
    {
        $response = $this->get('/api/positions/search?' . static::getApiToken());

        $response->assertStatus(200);
        $response->assertJsonFragment(['current_page' => 1]);
        $resp_array = $response->json();
        $this->assertTrue(array_key_exists('data', $resp_array));
        $this->assertTrue(array_key_exists('total', $resp_array));
    }

    /**
     * Test /api/positions/search list xml format
     *
     * @return void
     */
    public function test_positions_index_xml()
    {
        $response = $this->get('/api/positions/search?format=xml&' . static::getApiToken());

        $response->assertStatus(200);

        $xml = simplexml_load_string($response->getContent());

        $this->assertTrue((int)$xml->current_page === 1);
        $this->assertNotEmpty((string)$xml->data->row_0->mmsi);
        $this->assertTrue((int)$xml->total > 0);
    }

    /**
     * Test /api/positions/search list csv format
     *
     * @return void
     */
    public function test_positions_index_csv()
    {
        $response = $this->get('/api/positions/search?format=csv&' . static::getApiToken());

        $response->assertStatus(200);

        $csv = $response->getContent();

        $this->assertTrue(str_contains($csv, '"mmsi","status","speed","lat","lon","course","heading","rot","timestamp"'));
    }

}
