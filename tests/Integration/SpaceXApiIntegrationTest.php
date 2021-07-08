<?php

namespace Tests\Integration;

use App\Models\SpaceXApiModel;
use App\Models\User;
use Database\Factories\SpaceXApiModelFactory;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Passport\Passport;
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
    public function test_spacex_resource_api_can_work_functionally()
    {
        Passport::actingAs(User::factory()->create());

        $tempModel = SpaceXApiModel::factory()->make();

        $tempModel2 = SpaceXApiModel::factory()->make();

        $this->get(route('spaceXApi.showByFilter'))->assertStatus(200);

        $this->post(route('spaceXApi.store'), $tempModel->toArray())->assertStatus(201);

        $this->get(route('spaceXApi.show', ['capsule_serial' => $tempModel->capsule_serial]))->assertStatus(200);

        $this->put(route('spaceXApi.update', [$tempModel->capsule_serial]), $tempModel2->toArray())->assertStatus(200);

        $this->get(route('spaceXApi.show', ['capsule_serial' => $tempModel2->capsule_serial]))->assertStatus(200);

        $this->get(route('spaceXApi.showByFilter', ['status' => $tempModel2->status]))->assertStatus(200)->assertJsonCount(1);

        $this->delete(route('spaceXApi.destroy', ['capsule_serial' => $tempModel2->capsule_serial]))->assertStatus(204);

        $this->get(route('spaceXApi.showByFilter'))->assertStatus(200)->assertJsonCount(1);
    }
}
