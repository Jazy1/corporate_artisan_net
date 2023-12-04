<?php

namespace App\Http\Controllers;

use App\Models\Freelancer;
use App\Http\Requests\StoreFreelancerRequest;
use App\Http\Requests\UpdateFreelancerRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class FreelancerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function dashboard()
    {
        return view("freelancer.dashboard");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('freelancer.register');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFreelancerRequest $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:freelancers',
            'password' => 'required|string|min:8',
        ]);

        Freelancer::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route("freelancers.loginForm")->with('success', 'registeration done Login'); // or wherever you want to redirect after registration
    }

    /**
     * Show the login form
     */
    public function loginForm()
    {
        return view('freelancer.login');
    }
    
    /**
     * Log the freelancer in
     */
    public function login(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');
        
        // Retrieve the user data from the database
        $freelancer = Freelancer::where('email', $email)->first();
    
        if ($freelancer) {
            // Verify the password
            if (password_verify($password, $freelancer->password)) {
                // Password is correct, create a session and return the user ID
                session()->put(["LoggedFreelancer" => $freelancer->id]);
                return redirect()->route("freelancers.dashboard");
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
        if (session()->has('LoggedFreelancer')) {
            session()->pull("LoggedFreelancer");
            return redirect()->route("freelancers.loginForm")->with('success', 'you logged out');
        }else{
            return "m";
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Freelancer $freelancer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Freelancer $freelancer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFreelancerRequest $request, Freelancer $freelancer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Freelancer $freelancer)
    {
        //
    }
}
