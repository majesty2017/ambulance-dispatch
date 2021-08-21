<?php

namespace App\Http\Controllers;

use App\Models\DriverInfo;
use App\Models\Route;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DriverInfoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        $breadcrumbs = [['link' => "/", 'name' => "Home"],['name' => "Driver Info"]];
        return view('content.drivers.index', compact('breadcrumbs'));
    }


    public function store(Request $request)
    {
        $v = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'qualification' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:255|unique:users',
            'dob' => 'required|date',
        ]);
        if ($v->fails()) {
            return response()->json(['status' => 'fail', 'error' => $v->errors()]);
        }
        $driver = new DriverInfo();
        $driver->first_name = $request->first_name;
        $driver->last_name = $request->last_name;
        $driver->other_name = $request->other_name;
        $driver->qualification = $request->qualification;
        $driver->phone = $request->phone;
        $driver->route_id = $request->route_id;
        $driver->email = $request->email;
        $driver->address = $request->address;
        $driver->dob = date('Y-m-d', strtotime($request->dob));
        $driver->route_id = 1;
        $driver->gender = $request->gender;
        if ($driver->save()) {
            return response()->json(['data' => $driver, 'message' => 'Driver records saved successfully.'], 201);
        }
        return response()->json(['error' => 'Something went wront. Contact the administrator!']);
    }

    public function drivers()
    {
        $drivers = DriverInfo::orderBy('id', 'DESC')->with('location')->get();
        return response()->json(['data' => $drivers]);
    }

    public function get_routes()
    {
        $routes = Route::orderBy('id', 'DESC')->get();
        return response()->json($routes);
    }

    public function show(Request $request)
    {
        $driver = DriverInfo::with('location')->find($request->id);
        return response()->json($driver);
    }

    public function update(Request $request)
    {
        $v = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'qualification' => 'required|string|max:255',
            'phone' => 'required|string|max:12',
            'email' => 'required|email|max:255',
            'dob' => 'required|date',
        ]);
        if ($v->fails()) {
            return response()->json(['status' => 'fail', 'error' => $v->errors()]);
        }
        $driver = DriverInfo::find($request->id);
        $driver->first_name = $request->first_name;
        $driver->last_name = $request->last_name;
        $driver->other_name = $request->other_name;
        $driver->qualification = $request->qualification;
        $driver->phone = $request->phone;
        $driver->route_id = $request->route_id;
        $driver->email = $request->email;
        $driver->address = $request->address;
        $driver->dob = date('Y-m-d', strtotime($request->dob));
        $driver->gender = $request->gender;
        if ($driver->update()) {
            return response()->json(['data' => $driver, 'message' => 'Driver records saved successfully.'], 201);
        }
        return response()->json(['error' => 'Something went wront. Contact the administrator!']);
    }

    public function destrory($id)
    {
        $driver = DriverInfo::find($id);
        if ($driver->delete()) {
            return response()->json(['data' => $driver, 'message' => 'Record deleted successfully.']);
        }
        return response()->json(['error' => 'Something went wront. Contact the administrator!']);
    }
}
