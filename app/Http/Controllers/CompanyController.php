<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Http\Requests\StoreCompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('company.register');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCompanyRequest $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:companies',
            'password' => 'required|string|min:8',
        ]);

        Company::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route("companies.loginForm")->with('success', 'registeration done Login'); 
    }

    /**
     * Show the login form
     */
    public function loginForm()
    {
        return view('company.login');
    }
    
    /**
     * Log the company in
     */
    public function login(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');
        
        // Retrieve the user data from the database
        $company = Company::where('email', $email)->first();
    
        if ($company) {
            // Verify the password
            if (password_verify($password, $company->password)) {
                // Password is correct, create a session and return the user ID
                session()->put(["LoggedCompany" => $company->id]);
                return redirect()->route("companies.dashboard");
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
     * Display a listing of the resource.
     */
    public function dashboard()
    {
        return view("company.dashboard");
    }

    /**
     * Log the user out.
     */
    public function logout(){
        if (session()->has('LoggedCompany')) {
            session()->pull("LoggedCompany");
            return redirect()->route("companies.loginForm")->with('success', 'you logged out');
        }else{
            return "m";
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Company $company)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Company $company)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCompanyRequest $request, Company $company)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company)
    {
        //
    }
}
