<?php

namespace App\Http\Controllers;

use App\Models\SpaceXApiModel;
use Illuminate\Http\Request;

class SpaceXApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return SpaceXApiModel::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     * if process is successfull returns response with 201 Http code else 404
     */
    public function store(Request $request)
    {
        if (is_array($request->missions)) {
            $missions = serialize($request->missions);
        } else {
            $missions = $request->missions;
        }
        $tempCapsuleModel = new SpaceXApiModel();
        $tempCapsuleModel->capsule_serial = $request->capsule_serial;
        $tempCapsuleModel->capsule_id = $request->capsule_id;
        $tempCapsuleModel->status = $request->status;
        $tempCapsuleModel->original_launch = $request->original_launch;
        $tempCapsuleModel->original_launch_unix = $request->original_launch_unix;
        $tempCapsuleModel->missions = $missions;
        $tempCapsuleModel->landings = $request->landings;
        $tempCapsuleModel->type = $request->type;
        $tempCapsuleModel->details = $request->details;
        $tempCapsuleModel->reuse_count = $request->reuse_count;
        $tempCapsuleModel->save();

        return response('Model/s are added to database successfully', 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * if process is successfull returns response with 200 Http code else 404
     */
    public function show($id)
    {
        $capsule = SpaceXApiModel::findOrFail($id);

        return response()->json($capsule);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * if process is successfull returns response with 200 Http code else 404
     */
    public function update(Request $request, $id)
    {
        # Get the model from database
        $capsule = SpaceXApiModel::findOrFail($id);

        # Update the model with its given parameters
        $capsule = $capsule->update($request->all());

        return response('The instance is updated successfully!', 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response 
     * if process is successfull returns response with 204 Http code else 404.
     */
    public function destroy($id)
    {
        $capsule = SpaceXApiModel::findOrFail($id);

        $capsule->delete();

        return response('The instance is deleted successfully!', 204);
    }
}
