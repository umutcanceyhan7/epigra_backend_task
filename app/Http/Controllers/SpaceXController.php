<?php

namespace App\Http\Controllers;

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
        $rawData = Http::get("https://api.spacexdata.com/v3/capsules");
        $rawData = json_decode($rawData);
        return response($rawData, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request_body = $request->all();
        foreach ($request_body as $capsule) {
            if (gettype($capsule['missions']) == gettype(array())) {
                $missions = serialize($capsule['missions']);
            } else {
                $missions = $capsule['missions'];
            }
            $tempModel = new SpaceXApiModel();
            $tempModel->capsule_serial = $capsule['capsule_serial'];
            $tempModel->capsule_id = $capsule['capsule_id'];
            $tempModel->status = $capsule['status'];
            $tempModel->original_launch = $capsule['original_launch'];
            $tempModel->original_launch_unix = $capsule['original_launch_unix'];
            $tempModel->missions = $missions;
            $tempModel->landings = $capsule['landings'];
            $tempModel->type = $capsule['type'];
            $tempModel->details = $capsule['details'];
            $tempModel->reuse_count = $capsule['reuse_count'];
            $tempModel->save();
        }

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
        $capsule = SpaceXApiModel::where('id', $id)->get();

        if ($capsule != null) {
            return response()->json($capsule);
        } else {
            return response('The instance that you are looking for could not be found!', 404);
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
        $capsule = SpaceXApiModel::where('id', $id);
        if($capsule == null){
            $response = SpaceXController::store($request);
            return $response;
        }
        else if($capsule == []){
            $response = SpaceXController::store($request);
            return $response;
        }
        else{
            $capsule = $capsule->update($request->all());

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
        $capsule = SpaceXApiModel::where('id', $id);

        if ($capsule != null) {
            $capsule->delete();
            return response('The instance is deleted successfully!', 204);
        } else {

            return response('The instance that you are looking for could not be found!', 404);
        }
    }
}
