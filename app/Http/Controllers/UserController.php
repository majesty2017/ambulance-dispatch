<?php

namespace App\Http\Controllers;

use App\Models\User;
use http\Env\Response;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $breadcrumbs = [['link' => "/", 'name' => "Home"],['name' => "Users"]];
        return view('content.users.index', compact('breadcrumbs'));
    }

    public function store(Request $request)
    {
        $v = Validator::make($request->all(), [
           'first_name' => 'required|string|max:255',
           'last_name' => 'required|string|max:255',
           'qualification' => 'required|string|max:255',
           'phone' => 'required|string|max:12',
           'email' => 'required|email|max:255|unique:users',
           'password' => 'required|min:8|string|same:password_confirmation',
           'dob' => 'required|date',
        ]);
        if ($v->fails()) {
            return response()->json(['status' => 'fail', 'error' => $v->errors()]);
        }
        $user = new User();
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->other_name = $request->other_name;
        $user->qualification = $request->qualification;
        $user->phone = $request->phone;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->address = $request->address;
        $user->dob = date('Y-m-d', strtotime($request->dob));
        $user->rank = $request->rank;
        $user->gender = $request->gender;
        if ($request->hasFile('profile')) {
            $validator = Validator::make($request->all(), [
               'profile' => 'mimes:jpg, jpeg, png, svg, gif',
            ]);
            if ($validator->fails()) {
                return response()->json(['status' => 'fail', 'error' => $v->errors()]);
            }
            $file = $request->file('profile');
            $ext = $file->getClientOriginalExtension();
            $filename = time().'.'.$ext;
            $file->move('images/profile/user-uploads', $filename);
            $user->profile = $filename;
        }
        if ($user->save()) {
            return response()->json(['data' => $user, 'message' => 'User records saved successfully.'], 201);
        }
        return response()->json(['error' => 'Something went wront. Contact the administrator!']);
    }

    public function users()
    {
        $users = User::orderBy('id', 'DESC')->get();
        return response()->json(['data' => $users]);
    }

    public function show(Request $request)
    {
        $user = User::find($request->id);
        return response()->json($user);
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
        $user = User::find($request->id);
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->other_name = $request->other_name;
        $user->qualification = $request->qualification;
        $user->phone = $request->phone;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->address = $request->address;
        $user->dob = date('Y-m-d', strtotime($request->dob));
        $user->rank = $request->rank;
        $user->gender = $request->gender;
        if ($request->hasFile('profile')) {
            $validator = Validator::make($request->all(), [
                'profile' => 'mimes:jpg, jpeg, png, svg, gif',
            ]);
            if ($validator->fails()) {
                return response()->json(['status' => 'fail', 'error' => $v->errors()]);
            }
            $file = $request->file('profile');
            $ext = $file->getClientOriginalExtension();
            $filename = time().'.'.$ext;
            $file->move('images/profile/user-uploads', $filename);
            $user->profile = $filename;
        }
        if ($user->update()) {
            return response()->json(['data' => $user, 'message' => 'User records saved successfully.'], 201);
        }
        return response()->json(['error' => 'Something went wront. Contact the administrator!']);
    }

    public function destrory($id)
    {
        $user = User::find($id);
        if ($user->delete()) {
            return response()->json(['data' => $user, 'message' => 'User records saved successfully.']);
        }
        return response()->json(['error' => 'Something went wront. Contact the administrator!']);
    }
}
