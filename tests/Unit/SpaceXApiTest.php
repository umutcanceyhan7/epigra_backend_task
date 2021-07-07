<?php

namespace Tests\Unit;

use App\Models\SpaceXApiModel;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Event;
use Mockery\Generator\StringManipulation\Pass\Pass;
use Tests\TestCase;

class SpaceXApiTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test if the request has no query parameters, show by filter method calls index method and gets all models.
     */

    public function test_show_by_filter_method_can_go_index_method_and_get_all_models_if_there_is_no_query_parameters()
    {
        #create temp model for database.
        SpaceXApiModel::factory()->create();
        #test get model and response.
        $this->get(route('spaceXApi.showByFilter'))->assertStatus(200)->assertJsonCount(1);
    }

    /**
     * Test if the store method can create a spacex model
     */
    public function test_store_method_can_create_spacex_model()
    {

        $tempModel = SpaceXApiModel::factory()->make();


        $this->post(route('spaceXApi.store'), $tempModel->toArray())->assertStatus(201);
    }

    /**
     * Test if there is query parameters show by filter method filters the models according to.
     */
    public function test_show_by_filter_method_can_filter_models_according_to_query_parameters()
    {
        #create temp model for database
        $tempModel = SpaceXApiModel::factory()->create();
        #test showByFilter method
        $this->get(route('spaceXApi.showByFilter', ['status' => $tempModel->status]))->assertStatus(200);
    }

    /**
     * Test the update method can update created spacex model.
     */

    public function test_update_method_can_update_spacex_model()
    {

        $tempModel1 = SpaceXApiModel::factory()->create();

        $tempModel2 = SpaceXApiModel::factory()->make();

        $this->put(route('spaceXApi.update', $tempModel1->capsule_serial), $tempModel2->toArray())->assertStatus(200)->assertSee('The instance is updated successfully!');
    }

    /**
     * Test show method returns correct spacex model
     */
    public function test_show_method_shows_correct_spacex_model()
    {
        #create temp model to database
        $tempModel = SpaceXApiModel::factory()->create();

        #tests the request and response than tests if the model is the correct spacex model.
        $this->get(route('spaceXApi.show', ['capsule_serial' => $tempModel->capsule_serial]))->assertStatus(200)->assertSee(['capsule_serial' => $tempModel->capsule_serial]);
    }

    /**
     * Test destroy method deletes the spacex model
     */
    public function test_destroy_method_deletes_spacex_model()
    {
        $tempModel = SpaceXApiModel::factory()->create();

        $this->delete(route('spaceXApi.destroy', ['capsule_serial' => $tempModel->capsule_serial]))->assertStatus(204);
    }
}
