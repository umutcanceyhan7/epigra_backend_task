<?php

namespace Tests\Integration;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Mockery\Generator\StringManipulation\Pass\Pass;
use Tests\TestCase;

class SpaceXApiTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_index_method_can_get_all_models()
    {
        $this->get(route('generated::k8zJ5GW7qjG9ruW3'))->assertStatus(200);
    }
    public function test_store_method_can_create_spacex_model()
    {
        $tempModel = [
            'capsule_serial' => 'C801',
            'capsule_id' => 'dragon33',
            'status' => 'faded',
            'original_launch' => '2010-12-08T15:43:00.000Z',
            'original_launch_unix' => '1291822980',
            'missions' => '[{"name":"COTS 1","flight":7}]',
            'landings' => '1',
            'type' => 'Dragon 1.0',
            'details' => 'Reentered after three weeks in orbit',
            'reuse_count' => '0',
        ];

        $this->post(route('generated::NbLDYtQdh3cJAa8m'), $tempModel)->assertStatus(201);
    }

    public function test_update_method_can_update_spacex_model()
    {
        
    }
}
