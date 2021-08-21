<?php

namespace App\Http\Controllers;

use App\Models\DispatchStatus;
use App\Models\DriverInfo;
use App\Models\ERequest;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DispatchStatusController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $breadcrumbs = [['link' => "/", 'name' => "Home"],['name' => "Dispatch Status"]];
        return view('content.dispatch_status.index', compact('breadcrumbs'));
    }

    public function requests()
    {
        $requests = ERequest::orderBy('id', 'DESC')->get();
        return response()->json($requests);
    }

    public function store(Request $request)
    {
        $v = Validator::make($request->all(), [
           'driver_id' => 'required',
           'request_id' => 'required',
           'status' => 'required',
        ]);
        if ($v->fails()) {
            return response()->json(['status' => 'fail', 'error' => $v->errors()]);
        }
        $dispatch = new DispatchStatus;
        $dispatch->driver_id = $request->driver_id;
        $dispatch->admin_id = auth()->id();
        $dispatch->request_id = $request->request_id;
        $dispatch->status = $request->status;
//        SMS Setup
        $driver = DriverInfo::where('id', $request->driver_id)->first();
        $erequest = ERequest::where('id', $request->request_id)->first();
        $driver_phone = $driver->phone;
        $driver_name = $driver->first_name.' '.$driver->other_name.' '.$driver->last_name;
        $admin_message = 'Driver '.$driver_name.' dispatched';
        $driver_message = 'Dear '.$driver_name.', you are being dispached to '.$erequest->location;
        SmsConfigController::send_sms(auth()->user()->phone, $admin_message);
        SmsConfigController::send_sms($driver_phone, $driver_message);

        if ($dispatch->save()) {
            return response()->json(['data' => $dispatch, 'message' => 'Record saved successfully.']);
        }
        return false;
    }

    public function dispatch_statuses()
    {
        $dispatch_statuses = DispatchStatus::orderBy('id', 'DESC')->with(['request', 'driver', 'admin'])->get();
        return response()->json(['data' => $dispatch_statuses]);
    }

    public function show(Request $request)
    {
        $dispatch_statuses = DispatchStatus::with('request', 'driver', 'admin')->find($request->id);
        return response()->json($dispatch_statuses);
    }

    public function update(Request $request)
    {
        $v = Validator::make($request->all(), [
            'driver_id' => 'required',
            'request_id' => 'required',
            'status' => 'required',
        ]);
        if ($v->fails()) {
            return response()->json(['status' => 'fail', 'error' => $v->errors()]);
        }
        $dispatch = DispatchStatus::find($request->id);
        $dispatch->driver_id = $request->driver_id;
        $dispatch->admin_id = auth()->id();
        $dispatch->request_id = $request->request_id;
        $dispatch->status = $request->status;
        if ($dispatch->update()) {
            return response()->json(['data' => $dispatch, 'message' => 'Changes saved successfully.']);
        }
        return false;
    }

    public function destroy($id)
    {
        $dispatch = DispatchStatus::find($id);
        if ($dispatch->delete()) {
            return response()->json(['data' => $dispatch, 'message' => 'Record deleted successfully.']);
        }
        return false;
    }
}
