<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Http\Requests\StoreAdminRequest;
use App\Http\Requests\UpdateAdminRequest;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Display a listing of the resource.
     */
    public function dashboard()
    {
        return view("admin.dashboard");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAdminRequest $request)
    {
        //
    }

    /**
     * Show the login form
     */
    public function loginForm()
    {
        return view('admin.login');
    }

    /**
     * Log the admin in
     */
    public function login(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');
        
        // Retrieve the user data from the database
        $admin = Admin::where('email', $email)->first();
    
        if ($admin) {
            // Verify the password
            if (password_verify($password, $admin->password)) {
                // Password is correct, create a session and return the user ID
                session()->put(["LoggedAdmin" => $admin->id]);
                return redirect()->route("admin.dashboard");
            } else {
                // Password is incorrect
                return redirect()->back()->with("fail", "Password is not correct");
            }
        } else {
            // User not found
            return redirect()->back()->with("fail", "Email is not there");
        }
    }

    /**
     * Log the user out.
     */
    public function logout(){
        if (session()->has('LoggedAdmin')) {
            session()->pull("LoggedAdmin");
            return redirect()->route("admin.loginForm")->with('success', 'you logged out');
        }else{
            return "m";
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Admin $admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Admin $admin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAdminRequest $request, Admin $admin)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Admin $admin)
    {
        //
    }
}
