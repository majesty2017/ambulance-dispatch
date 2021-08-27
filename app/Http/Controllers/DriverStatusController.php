<?php

namespace App\Http\Controllers;

use App\Models\DispatchStatus;
use App\Models\DriverInfo;
use App\Models\DriverStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DriverStatusController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $breadcrumbs = [['link' => "/", 'name' => "Home"],['name' => "Driver Status"]];
        return view('content.driver_status.index', compact('breadcrumbs'));
    }

    public function store(Request $request)
    {
        $v = Validator::make($request->all(), [
            'driver_id' => 'required',
            'status' => 'required'
        ]);
        if ($v->fails()) {
            return response()->json(['status' => 'fail', 'error' => $v->errors()]);
        }
        $status = new DriverStatus;
        $status->driver_id = $request->driver_id;
        $status->status = $request->status;
        if ($status->save()) {
            DispatchStatus::where('driver_id', $request->driver_id)->update([
                'status' => $request->status,
            ]);
            return response()->json(['data' => $status, 'message' => 'Record saved successfully.']);
        }
        return false;
    }

    public function driver_statuses()
    {
        $statues = DriverStatus::orderBy('id', 'DESC')->with('driver')->get();
        return response()->json(['data' => $statues]);
    }

    public function driver_status(Request $request)
    {
        $status = DriverStatus::where('driver_id', $request->driver_id)->first();
        return response()->json($status);
    }

    public function show(Request $request)
    {
        $status = DriverStatus::with('driver')->find($request->id);
        return response()->json($status);
    }

    public function update(Request $request)
    {
        $v = Validator::make($request->all(), [
            'driver_id' => 'required',
            'status' => 'required'
        ]);
        if ($v->fails()) {
            return response()->json(['status' => 'fail', 'error' => $v->errors()]);
        }
        $status = DriverStatus::find($request->id);
        $status->driver_id = $request->driver_id;
        $status->status = $request->status;
        if ($status->update()) {
            DispatchStatus::where('driver_id', $request->driver_id)->update([
                'status' => $request->status,
            ]);
            return response()->json(['data' => $status, 'message' => 'Changes saved successfully.']);
        }
        return false;
    }

    public function destroy($id)
    {
        $status = DriverStatus::find($id);

        if ($status->delete()) {
            return response()->json(['data' => $status, 'message' => 'Record deleted successfully.']);
        }
        return false;
    }
}
