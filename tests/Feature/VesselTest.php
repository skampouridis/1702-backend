<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class VesselTest extends TestCase
{

    /**
     * Test /api/vessels without token
     *
     * @return void
     */
    public function test_vessels_route_without_token()
    {
        $response = $this->get('/api/vessels');

        $response->assertStatus(401);
    }

    /**
     * Test /api/vessels list
     *
     * @return void
     */
    public function test_vessels_index()
    {
        $response = $this->get('/api/vessels?' . static::getApiToken());

        $response->assertStatus(200);
        $response->assertJsonFragment(['current_page' => 1]);
        $resp_array = $response->json();
        $this->assertTrue(array_key_exists('data', $resp_array));
        $this->assertTrue(array_key_exists('total', $resp_array));
    }

    /**
     * Test /api/vessels store
     *
     * @return void
     */
    public function test_vessels_store()
    {
        $data = ['name' => 'test name', 'mmsi' => 'test mmsi'];
        $response = $this->post('/api/vessels?' . static::getApiToken(), $data);

        $response->assertStatus(201);
        $response->assertJsonFragment($data);
        $resp_array = $response->json();
        $this->assertTrue(!empty($resp_array['id']));
    }

    /**
     * Test /api/vessels/1 show
     *
     * @return void
     */
    public function test_vessels_show()
    {
        $response = $this->get('/api/vessels/1?' . static::getApiToken());

        $response->assertStatus(200);
        $response->assertJsonFragment(['id' => 1]);
    }

    /**
     * Test /api/vessels/1 update
     *
     * @return void
     */
    public function test_vessels_update()
    {
        $data = ['name' => 'test name 1 upd', 'mmsi' => 'test mmsi 1 upd'];
        $response = $this->put('/api/vessels/1?' . static::getApiToken(), $data);

        $response->assertStatus(200);
        $response->assertJson($data);
    }

    /**
     * Test /api/vessels/1 destroy
     *
     * @return void
     */
    public function test_vessels_destroy()
    {
        $last = \DB::select("SELECT `id` FROM `vessels` WHERE `id` <> 1 ORDER BY `id` DESC LIMIT 1");
        $this->assertTrue(!empty($last[0]->id));

        if ((!empty($last[0]->id))) {
            $id = $last[0]->id;
            $response = $this->delete('/api/vessels/' . $id . '?' . static::getApiToken());

            $response->assertStatus(204);
        }
    }

}
