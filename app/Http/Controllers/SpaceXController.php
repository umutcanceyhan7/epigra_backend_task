<?php

namespace App\Http\Controllers;

use App\Events\SpaceXDataFetchEvent;
use App\Events\SyncSpaceXDataToDatabaseEvent;
use App\Models\SpaceXApiModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Response;

class SpaceXController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        

        return response('Model/s are added to database successfully', 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $capsule = SpaceXApiModel::where('id', $id)->first();

        if (is_null($capsule)) {
            return response('The instance that you are looking for could not be found!', 404);
        } else {
            return response('Success', 200)->json($capsule);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        # Get the model from database
        $tempModel = SpaceXApiModel::where('id', $id)->first();
        # If the model is empty return 404
        if (is_null($tempModel)) {
            return response('Model is Null or Deleted!', 404);
        } else {
            # Update the model with its given parameters
            $tempModel = $tempModel->update($request->all());

            return response('The instance is updated successfully!', 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $capsule = SpaceXApiModel::where('id', $id)->first();

        if ($capsule != null) {
            $capsule->delete();
            return response('The instance is deleted successfully!', 204);
        } else {

            return response('The instance that you are looking for could not be found!', 404);
        }
    }
}
