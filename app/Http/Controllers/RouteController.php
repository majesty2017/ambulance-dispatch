<?php

namespace App\Http\Controllers;

use App\Models\Route;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RouteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $breadcrumbs = [['link' => "/", 'name' => "Home"],['name' => "Routes Info"]];
        return view('content/routes/index', compact('breadcrumbs'));
    }

    public function store(Request $request)
    {
        $v = Validator::make($request->all(), [
           'hospital' => 'required|string|max:255|unique:routes'
        ]);
        if ($v->fails()) {
            return response()->json(['status' => 'fail', 'error' => $v->errors()]);
        }
        $route = new Route();
        $route->hospital = $request->hospital;
        if ($route->save()) {
            return response()->json(['data' => $route, 'message' => 'Record saved successfully.'], 201);
        }
        return false;
    }

    public function routes()
    {
        $routes = Route::orderBy('id', 'DESC')->get();
        return response()->json(['data' => $routes]);
    }

    public function show(Request $request)
    {
        $route = Route::find($request->id);
        return response()->json($route);
    }

    public function update(Request $request)
    {
        $v = Validator::make($request->all(), [
            'hospital' => 'required|string|max:255|unique:routes'
        ]);
        if ($v->fails()) {
            return response()->json(['status' => 'fail', 'error' => $v->errors()]);
        }
        $route = Route::find($request->id);
        $route->hospital = $request->hospital;
        if ($route->update()) {
            return response()->json(['data' => $route, 'message' => 'Record saved successfully.'], 201);
        }
        return false;
    }

    public function destrory($id)
    {
        $route = Route::find($id);
        if ($route->delete()) {
            return response()->json(['data' => $route, 'message' => 'Record deleted successfully.']);
        }
        return response()->json(['error' => 'Something went wront. Contact the administrator!']);
    }
}
