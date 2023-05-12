<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index(Request $request)
    {

        // first check if you are loggedin and admin user ...
        //return Auth::check();

        if (!Auth::check() && $request->path() != 'login') {
            return redirect('/login');
        }

        if (!Auth::check() && $request->path() == 'login') {
            return view('welcome');
        }
        // you are already logged in... so check for if you are an admin user..
        $user = Auth::user();
        if ($user->userType == 'User') {
            return redirect('/login');
        }
        if ($request->path() == 'login') {
            return redirect('/');
        }

        return view('welcome',compact('user'));
    }



    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
    public function create(Request $request)
    {
        $this->validate($request,[
            'fullName' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'userType' => 'required',
        ]);

        $password = bcrypt($request->password);
        return User::create(
            [
                'fullName' => $request->fullName,
                'email' => $request->email,
                'password' => $password,
                'userType'  => $request->userType,
            ]
            );

    }

    // edit function
    public function edit(Request $request)
    {
        $this->validate($request,[
            'fullName' => 'required',
            'email' => "bail|required|email|unique:users,email,$request->id",
            'password' => 'min:6',
            'userType' => 'required',
            'id'=>'required'
        ]);

        $data =  [
            'fullName' => $request->fullName,
            'email' => $request->email,
            'userType'  => $request->userType,
        ];

        if($request->password){
            $password = bcrypt($request->password);
           $data['password'] = $password;
        };

         $user =  User::where('id',$request->id)->update($data);
         return $user;
    }

    //users data

    public function get_users(){
        return User::orderBy('id','DESC')->where('userType','!=','User')->get();
    }

    //dele user

    public function delete(Request $request)
    {
        $this->validate($request,[
            'id'=>'required'
        ]);
         return User::where('id',$request->id)->delete();
    }

    public function adminLogin(Request $request)
    {
        // validate request
        $this->validate($request, [
            'email' => 'bail|required|email',
            'password' => 'bail|required|min:6',
        ]);
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            if ($user->userType == 'User') {
                Auth::logout();
                return response()->json([
                    'msg' => 'Incorrect login details',
                ], 401);
            }
            return response()->json([
                'msg' => 'You are logged in',
                'user' => $user,
            ]);
        } else {
            return response()->json([
                'msg' => 'Incorrect login details',
            ], 401);
        }
    }
}
