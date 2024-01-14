<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Http\Requests\StoreCompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;
use App\Models\BankAccounts;
use App\Models\Category;
use App\Models\Order;
use App\Models\Transactions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

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
    public function dashboard(Request $request){
        $company = Company::find($request->company->id);
        $bankAccount = BankAccounts::where('user_type', 'company')->where('user_id', $company->id)->first();
        $currentAmount = $bankAccount ? $bankAccount->current_balance : 0;

        $orderCount = $company->orders->count(); 
        $cancelledOrderCount = Order::where("company_id", $company->id)->where("status", "cancelled")->get()->count();
        $pendingOrderCount = Order::where("company_id", $company->id)->where("status", "pending")->get()->count();
        
        return view("company.dashboard", [
            "company" => $company,
            "orderCount" => $orderCount,
            "currentAmount" => $currentAmount,
            "cancelledOrderCount" => $cancelledOrderCount,
            "pendingOrderCount" => $pendingOrderCount,
        ]);
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

    function profilePage(Request $request) {
        $company = Company::find($request->company->id);
        $bankAccount = BankAccounts::where("user_type", "company")->where("user_id", $request->company->id)->first();
        return view("company.profile", [
            "company" => $company,
            "bankAccount" => $bankAccount
        ]);
    }

    public function update(Request $request, $id){
        $company = Company::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:freelancers,email,' . $company->id,
            'img' => 'image|mimes:jpeg,png,jpg,gif,svg|max:5120', // 5MB limit
            'password' => 'nullable',
        ]);

        // Delete old profile image if it exists and not named "default.svg"
        if ($company->image && $company->image !== '/img/profile-pictures/default.svg') {
            Storage::disk('profile-pictures')->delete($company->image);
        }

        // Update name and email
        $company->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        // Update profile image
        if ($request->hasFile('img')) {
            $imageName = time() . '_' . $request->file('img')->getClientOriginalName();
            $path = $request->file('img')->storeAs('img/profile-pictures/', $imageName, 'public');

            $company->update([
                'img' => 'storage/img/profile-pictures/' . $imageName,
            ]);
        }

        // Update password if provided
        if ($request->filled('password')) {
            $company->update([
                'password' => Hash::make($request->password),
            ]);
        }

        return redirect()->route('companies.profile')->with('success', 'Profile updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company)
    {
        //
    }

    function financesDashboard(Request $request) {
        $company = Company::find($request->company->id);
        // Retrieve bank account current balance (assuming there's only one bank account for the admin)
        $bankAccount = BankAccounts::where('user_type', 'company')->where('user_id', $company->id)->first();
        $currentBalance = $bankAccount ? $bankAccount->current_balance : 0;

        // Retrieve recent 10 transactions
        $lastTransactions = Transactions
            ::where("from", $company->id)
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get();

        return view("company.finances.dashboard", [
            "company" => $company,
            "currentBalance" => $currentBalance,
            "bankAccount" => $bankAccount,
            "lastTransactions" => $lastTransactions,
        ]);
    }

    function depositPage(Request $request) {
        $company = Company::find($request->company->id);

        $company = Company::find($request->company->id);
        $bankAccount = BankAccounts::where('user_type', 'company')->where('user_id', $company->id)->first();

        return view("company.finances.deposit", [
            "company" => $company,
            "bankAccount" => $bankAccount,
        ]);
    }
    
    public function depositCash(Request $request){
        $company = Company::find($request->company->id); // Assuming the admin is authenticated
        $amount = $request->input('amount');

        // Validate the amount (add more validation as needed)
        $request->validate([
            'amount' => 'required|numeric|min:0',
        ]);

        // Retrieve the bank account associated with the admin
        $bankAccount = BankAccounts::where('user_type', 'company')->where('user_id', $company->id)->first();

        if (!$bankAccount) {
            return response()->json(['error' => 'Bank account not found'], 404);
        }

        // Update the current_balance
        $bankAccount->current_balance += $amount;
        $bankAccount->save();

        // You can also create a new transaction record in the transactions table if needed

        // Return the updated bank account information
        return response()->json(['current_balance' => $bankAccount->current_balance]);
    }
    
    function withdrawPage(Request $request) {
        $company = Company::find($request->company->id);
        $bankAccount = BankAccounts::where('user_type', 'company')->where('user_id', $company->id)->first();
        $currentAmount = $bankAccount ? $bankAccount->current_balance : 0;

        return view("company.finances.withdraw", [
            "company" => $company,
            "currentAmount" => $currentAmount,
            "bankAccount" => $bankAccount
        ]);
    }
    
    public function withdrawCash(Request $request){
        $company = Company::find($request->company->id); // Assuming the admin is authenticated
        $amount = $request->input('amount');

        // Validate the amount (add more validation as needed)
        $request->validate([
            'amount' => 'required|numeric|min:0',
        ]);

        // Retrieve the bank account associated with the admin
        $bankAccount = BankAccounts::where('user_type', 'company')->where('user_id', $company->id)->first();

        if (!$bankAccount) {
            return response()->json(['error' => 'Bank account not found'], 404);
        }

        // Check if the withdrawal amount is greater than the current balance
        if ($amount > $bankAccount->current_balance) {
            return response()->json(['error' => 'Insufficient funds'], 422);
        }

        // Update the current_balance
        $bankAccount->current_balance -= $amount;
        $bankAccount->save();

        // You can also create a new transaction record in the transactions table if needed

        // Return the updated bank account information
        return response()->json(['current_balance' => $bankAccount->current_balance]);
    }
}
