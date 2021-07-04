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
        $this->test_store_method_can_create_spacex_model();
        #test get model and response.
        $this->get(route('spaceXApi.showByFilter'))->assertStatus(200)->assertJsonCount(1);
    }

    /**
     * Test if the store method can create a spacex model
     */
    public function test_store_method_can_create_spacex_model()
    {

        $tempModel = [
            'capsule_serial' => 'C1000',
            'capsule_id' => 'dragon33',
            'status' => 'retired',
            'original_launch' => '2010-12-08T15:43:00.000Z',
            'original_launch_unix' => '1291822980',
            'missions' => '[{"name":"COTS 1","flight":7}]',
            'landings' => '1',
            'type' => 'Dragon 1.0',
            'details' => 'Reentered after three weeks in orbit',
            'reuse_count' => '0',
        ];


        $this->post(route('spaceXApi.store'), $tempModel)->assertStatus(201);
    }

    /**
     * Test if there is query parameters show by filter method filters the models according to.
     */
    public function test_show_by_filter_method_can_filter_models_according_to_query_parameters()
    {
        #create temp model for database
        $this->test_store_method_can_create_spacex_model();
        #test showByFilter method
        $this->get(route('spaceXApi.showByFilter', ['status' => 'retired']))->assertStatus(200);
    }

    /**
     * Test the update method can update created spacex model.
     */

    public function test_update_method_can_update_spacex_model()
    {
        $this->test_store_method_can_create_spacex_model();

        $tempModel = [
            'capsule_serial' => 'C1000',
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

        $this->put(route('spaceXApi.update', $tempModel['capsule_serial']), $tempModel)->assertStatus(200)->assertSee('The instance is updated successfully!');
    }

    /**
     * Test show method returns correct spacex model
     */
    public function test_show_method_shows_correct_spacex_model()
    {
        #create temp model to database
        $this->test_store_method_can_create_spacex_model();

        #get temp model
        $tempModel = SpaceXApiModel::first();

        #tests the request and response than tests if the model is the correct spacex model.
        $this->get(route('spaceXApi.show', ['capsule_serial' => $tempModel->capsule_serial]))->assertStatus(200)->assertSee(['capsule_serial' => $tempModel->capsule_serial]);
    }

    /**
     * Test destroy method deletes the spacex model
     */
    public function test_destroy_method_deletes_spacex_model()
    {
        $this->test_store_method_can_create_spacex_model();

        $tempModel = SpaceXApiModel::first();

        $this->delete(route('spaceXApi.destroy', ['capsule_serial' => $tempModel->capsule_serial]), ['capsule_serial' => 'C1000'])->assertStatus(204);
    }
}
