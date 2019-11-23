<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Authority;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function getSignUp(){
        return view('welcome');
    }

    public function postSignUp(Request $request){
        
        $user = new User;
        
        $this->validate($request, [
            'username' => 'min:3|required',
            'password' => 'required|min:4',
            'confirmPassword' => 'same:password',
            'firstname' => 'required',
            'lastname' => 'required',
            'phoneNo' => 'required'
        ]);

        $user->username = $request->username;
        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->avatar = $request->avatar;
        $user->phoneNo = $request->phoneNo;

        if($request->hasFile('avatar')){
            $fileName = $request->file('avatar')->getClientOriginalName();
            $extension = $request->file('avatar')->getClientOriginalExtension();

            $fileNameToStore = $fileName;

            $user->avatar = $fileNameToStore;

            $path = $request->file('avatar')->storeAs('public/avatars', $fileNameToStore);
        }

        $message = "User could not be registered";
        

        if($user->save()){
            $user_id = $user->id;
            $authority = new Authority;
            $authority->userId = $user_id;
            $authority->addUser = $request->addUser ?: 0;
            $authority->addProduct = $request->addProduct ?: 0;
            $authority->updateProduct = $request->updateProduct ?: 0;
            $authority->accessReports = $request->accessReports ?: 0;
            $authority->save();
            $message = "You successfully created a user. You can log in now.";
        }

        return redirect()->back()->with('message', $message);
    }

    public function doSignin(Request $request){
        $credentials = $request->only('username', 'password'); 
        if(!Auth::attempt($credentials)){
            return redirect()->back()->with('err', 'Wrong credentials.');
        }else{
            return redirect()->route('dashboard');
        }
    }

    public function signin(){
        return view('welcome');
    }

    public function logout(){
        Auth::logout();
        return "you are logged out";
    }
}
