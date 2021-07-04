<?php

namespace Tests\Integration;

use App\Models\SpaceXApiModel;
use Database\Factories\SpaceXApiModelFactory;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SpaceXApiIntegrationTest extends TestCase
{
    use RefreshDatabase;
    use DatabaseMigrations;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_resource_api_can_work_functionally()
    {


        $this->get(route('spaceXApi.showByFilter'))->assertStatus(200);

        $tempModel = SpaceXApiModel::factory()->create();

        var_dump($tempModel->toArray());

        $this->post(route('spaceXApi.store'), $tempModel->toArray())->assertStatus(201);

        $this->get(route('spaceXApi.show', ['capsule_serial' => $tempModel->capsule_serial]))->assertStatus(200);

        $tempModel2 = SpaceXApiModel::factory()->create();

        $this->put(route('spaceXApi.update', ['capsule_serial' => $tempModel->capsule_serial]), $tempModel2->toArray())->assertStatus(200);

        $this->get(route('spaceXApi.showByFilter', ['status' => $tempModel2->status]))->assertStatus(200)->assertJsonCount(2);

        $this->delete(route('spaceXApi.destroy', ['capsule_serial' => $tempModel2->capsule_serial]))->assertStatus(204);

        $this->get(route('spaceXApi.showByFilter'))->assertStatus(200)->assertJsonCount(1);
    }
}
