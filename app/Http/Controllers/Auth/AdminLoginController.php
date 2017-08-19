<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class AdminLoginController extends Controller
{

    // Use the Guest:Admin middleware
    public function __construct() {
    	$this->middleware('guest:admin', ['except' => ['logout']]);
    }

    // Show the Login Form
    public function showLoginForm() {
    	return view('auth.admin-login');
    }

    // Login
    public function login(Request $request) {
    	// Validate Form Data
    	$this->validate($request, [
    		'email' => 'required|email',
    		'password' => 'required|min:6'
    	]);

    	$credentials = [
    		'email' => $request->email,
    		'password' => $request->password
    	];

    	// Attempt to log user in
    	if(Auth::guard('admin')->attempt($credentials, $request->remember)) {
    		// if successful then redirect to their intended location
    		return redirect()->intended(route('admin.dashboard'));
    	}

    	// if unsuccess then redirect back to the login with the form data
    	return redirect()->back()->withInput($request->only('email', 'remember'));
    }

    public function logout() {

      Auth::guard('admin')->logout();
      return redirect('/');

    }


}
