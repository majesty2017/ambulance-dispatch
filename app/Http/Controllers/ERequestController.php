<?php

namespace App\Http\Controllers;

use App\Models\ERequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ERequestController extends Controller
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
        $breadcrumbs = [['link' => "/", 'name' => "Home"],['name' => "Emergency Request"]];
        return view('content.e_request.index', compact('breadcrumbs'));
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        $v = Validator::make($request->all(), [
           'name' => 'required|string|max:255',
           'phone' => 'required|numeric',
           'request_method' => 'required|string',
           'location' => 'required|string|max:255',
           'message' => 'required|string',
        ]);
        if ($v->fails()) {
            return response()->json(['status' => 'fail', 'error' => $v->errors()]);
        }
        $e_request = new ERequest();
        $e_request->name = $request->name;
        $e_request->phone = $request->phone;
        $e_request->request_method = $request->request_method;
        $e_request->location = $request->location;
        $e_request->message = $request->message;
        if ($e_request->save()) {
            return response()->json(['data' => $e_request, 'message' => 'Emergency request records saved successfully']);
        }
        return response()->json(['fail' => 'Something went wrong!']);
    }

    /**
     * @return JsonResponse
     */
    public function requests()
    {
        $e_requests = ERequest::orderBy('id', 'DESC')->get();
        return response()->json(['data' => $e_requests]);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function show(Request $request)
    {
        $e_request = ERequest::find($request->id);
        return response()->json($e_request);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function update(Request $request)
    {
        $v = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'phone' => 'required|numeric',
            'request_method' => 'required|string',
            'location' => 'required|string|max:255',
            'message' => 'required|string',
        ]);
        if ($v->fails()) {
            return response()->json(['status' => 'fail', 'error' => $v->errors()]);
        }
        $e_request = ERequest::find($request->id);
        $e_request->name = $request->name;
        $e_request->phone = $request->phone;
        $e_request->request_method = $request->request_method;
        $e_request->location = $request->location;
        $e_request->message = $request->message;
        if ($e_request->update()) {
            return response()->json(['data' => $e_request, 'message' => 'Changes saved successfully']);
        }
        return response()->json(['fail' => 'Something went wrong!']);
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function destrory($id)
    {
        $e_request = ERequest::find($id);
        if ($e_request->delete()) {
            return response()->json(['data' => $e_request, 'message' => 'Emergency request record deleted successfully']);
        }
        return response()->json(['fail' => 'Something went wrong!']);
    }
}
