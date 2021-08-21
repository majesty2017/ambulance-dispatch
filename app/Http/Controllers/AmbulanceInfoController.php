<?php

namespace App\Http\Controllers;

use App\Models\AmbulanceInfo;
use App\Models\DriverInfo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AmbulanceInfoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

        $breadcrumbs = [['link' => "/", 'name' => "Home"],['name' => "Ambulance Info"]];
        return view('content.ambulances.index', compact('breadcrumbs'));
    }

    public function drivers()
    {
        $drivers = DriverInfo::orderBy('id', 'DESC')->get();
        return response()->json($drivers);
    }

    public function store(Request $request)
    {
        $v = Validator::make($request->all(), [
            'ambulance_model' => 'required|max:100',
            'manufacture_date' => 'required|date',
            'engine_num' => 'required',
            'driver_id' => 'required',
            'purchase_date' => 'required|date'
        ]);
        if ($v->fails()) {
            return response()->json(['status' => 'fail', 'error' => $v->errors()]);
        }
        $ambulance = new AmbulanceInfo();
        $ambulance->ambulance_model = $request->ambulance_model;
        $ambulance->manufacture_date = $request->manufacture_date;
        $ambulance->engine_num = $request->engine_num;
        $ambulance->driver_id = $request->driver_id;
        $ambulance->purchase_date = $request->purchase_date;

        if ($ambulance->save()) {
            return response()->json(['data' => $ambulance, 'message' => 'Record saved successfully']);
        }
        return false;
    }

    public function ambulances()
    {
        $ambulance = AmbulanceInfo::orderBy('id', 'DESC')->with('driver')->get();
        return response()->json(['data' => $ambulance]);
    }

    public function show(Request $request)
    {
        $ambulance = AmbulanceInfo::with('driver')->find($request->id);
        return response()->json($ambulance);
    }

    public function update(Request $request)
    {
        $v = Validator::make($request->all(), [
            'ambulance_model' => 'required|max:100',
            'manufacture_date' => 'required',
            'engine_num' => 'required',
            'driver_id' => 'required',
            'purchase_date' => 'required'
        ]);
        if ($v->fails()) {
            return response()->json(['status' => 'fail', 'error' => $v->errors()]);
        }
        $ambulance = AmbulanceInfo::find($request->id);
        $ambulance->ambulance_model = $request->ambulance_model;
        $ambulance->manufacture_date = $request->manufacture_date;
        $ambulance->engine_num = $request->engine_num;
        $ambulance->driver_id = $request->driver_id;
        $ambulance->purchase_date = $request->purchase_date;

        if ($ambulance->update()) {
            return response()->json(['data' => $ambulance, 'message' => 'Changes saved successfully']);
        }
        return false;
    }

    public function destroy($id)
    {
        $ambulance = AmbulanceInfo::find($id);

        if ($ambulance->delete()) {
            return response()->json(['data' => $ambulance, 'message' => 'Record deleted successfully']);
        }
        return false;
    }
}
