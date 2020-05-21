<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Parking;
use Illuminate\Http\Request;
use App\Http\Requests\Parking as ParkingRequests;
use App\Http\Requests\ParkingOut as ParkingRequestsOut;

class ParkingController extends Controller
{

    protected $parking;

    public function __construct(Parking $parking)
    {
        $this->parking = $parking;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json($this->parking->paginate());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ParkingRequests $request)
    {
        $parking = $this->parking->create($request->all());

        return response()->json($parking,201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Parking  $parking
     * @return \Illuminate\Http\Response
     */
    public function show(Parking $parking)
    {
        return response()->json($parking);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Parking  $parking
     * @return \Illuminate\Http\Response
     */
    public function update(ParkingRequestsOut $request, Parking $parking)
    {
        /*
        $today = new \DateTime();
        $interval = $today->diff($parking->intime);

        $request->time = $interval->format('%i');
        $request->amount = $request->time * 0.05;
        */
        //First sprint 
        $ts1 = strtotime($parking->intime);
        $ts2 = time();     
        $seconds_diff = $ts2 - $ts1;                            
        $time = ($seconds_diff/3600);

        switch ($parking->profile) {
            case "Resident":
                $request->time = $time;
                $request->amount = $request->time * 0.05;
                break;
            case "Official":
                $request->time = $time;
                $request->amount =0.00;

                break;
            default:
                $request->time = $time;
                $request->amount = $request->time * 0.05;
        
                break;
        }
       
        $parking->update($request->all());

        return response()->json($parking);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Parking  $parking
     * @return \Illuminate\Http\Response
     */
    public function destroy(Parking $parking)
    {
        $parking->delete();

        return response()->json(null,204);
    }
}
