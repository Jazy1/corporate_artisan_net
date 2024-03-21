<?php

namespace App\Http\Controllers;

use App\Models\Freelancer;
use App\Http\Requests\StoreFreelancerRequest;
use App\Http\Requests\UpdateFreelancerRequest;
use App\Models\BankAccounts;
use App\Models\Category;
use App\Models\Order;
use App\Models\Transactions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class FreelancerController extends Controller
{

    public function dashboard(Request $request){
        $freelancer = Freelancer::find($request->freelancer->id);
        $bankAccount = BankAccounts::where('user_type', 'freelancer')->where('user_id', $freelancer->id)->first();
        $currentAmount = $bankAccount ? $bankAccount->current_balance : 0;

        $orderCount = $freelancer->orders->count(); 
        $cancelledOrderCount = Order::where("company_id", $freelancer->id)->where("status", "cancelled")->get()->count();
        $pendingOrderCount = Order::where("company_id", $freelancer->id)->where("status", "pending")->get()->count();

        return view("freelancer.dashboard", [
            "freelancer" => $freelancer,
            "orderCount" => $orderCount,
            "currentAmount" => $currentAmount,
            "cancelledOrderCount" => $cancelledOrderCount,
            "pendingOrderCount" => $pendingOrderCount,
        ]);
    }

    public function create(){
        return view('freelancer.register');
    }

    public function store(StoreFreelancerRequest $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:freelancers',
            'password' => 'required|string|min:8',
        ]);

        Freelancer::create([
            'name' => $request->name,
            'email' => $request->email,
            'img' => '/img/profile-pictures/default.svg',
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route("freelancers.loginForm")->with('success', 'registeration done Login'); // or wherever you want to redirect after registration
    }

    public function loginForm(){
        return view('freelancer.login');
    }
    
    public function login(Request $request){
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

    public function logout(){
        if (session()->has('LoggedFreelancer')) {
            session()->pull("LoggedFreelancer");
            return redirect()->route("freelancers.loginForm")->with('success', 'you logged out');
        }else{
            return "m";
        }
    }

    function financesDashboard(Request $request) {
        $freelancer = Freelancer::find($request->freelancer->id);

        // Retrieve bank account current balance (assuming there's only one bank account for the freelancer)
        $bankAccount = BankAccounts::where('user_type', 'freelancer')->where('user_id', $freelancer->id)->first();
        $currentBalance = $bankAccount ? $bankAccount->current_balance : 0;

        // Retrieve recent 10 transactions
        $lastTransactions = Transactions
            ::where("to", $freelancer->id)->orderBy('created_at', 'desc')
            ->take(10)
            ->get();

        return view("freelancer.finances.dashboard", [
            "freelancer" => $freelancer,
            "currentBalance" => $currentBalance,
            "lastTransactions" => $lastTransactions,
        ]);
    }

    function withdrawPage(Request $request) {
        $freelancer = Freelancer::find($request->freelancer->id);
        $bankAccount = BankAccounts::where('user_type', 'freelancer')->where('user_id', $freelancer->id)->first();
        $currentAmount = $bankAccount ? $bankAccount->current_balance : 0;

        return view("freelancer.finances.withdraw", [
            "freelancer" => $freelancer,
            "currentAmount" => $currentAmount,
            "bankAccount" => $bankAccount
        ]);
    }
    
    public function withdrawCash(Request $request){
        $freelancer = Freelancer::find($request->freelancer->id); // Assuming the freelancer is authenticated
        $amount = $request->input('amount');

        // Validate the amount (add more validation as needed)
        $request->validate([
            'amount' => 'required|numeric|min:0',
        ]);

        // Retrieve the bank account associated with the admin
        $bankAccount = BankAccounts::where('user_type', 'freelancer')->where('user_id', $freelancer->id)->first();

        if (!$bankAccount) {
            return response()->json(['error' => 'Bank account not found'], 404);
        }

        // Check if the withdrawal amount is greater than the current balance
        if ($amount > $bankAccount->current_balance) {
            return response()->json(['error' => 'Insufficient funds'], 422);
        }

        // Deduction
        $deduction =  ($amount * 4) / 100;
        $amount = $amount - $deduction;
        $AdminBankAccount = BankAccounts::where('user_type', 'admin')->first();
        $AdminBankAccount->current_balance += $deduction;
        $AdminBankAccount->save();

        // Update the current_balance
        $bankAccount->current_balance -= $amount;
        $bankAccount->save();

        // You can also create a new transaction record in the transactions table if needed

        // Return the updated bank account information
        return response()->json(['current_balance' => $bankAccount->current_balance]);
    }

    function profilePage(Request $request) {
        $freelancer = Freelancer::find($request->freelancer->id);
        $bankAccount = BankAccounts::where("user_type", "freelancer")->where("user_id", $request->freelancer->id)->first();
        return view("freelancer.profile", [
            "freelancer" => $freelancer,
            "bankAccount" => $bankAccount
        ]);
    }

    public function update(Request $request, $id){
        $freelancer = Freelancer::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:freelancers,email,' . $freelancer->id,
            'img' => 'image|mimes:jpeg,png,jpg,gif,svg|max:5120', // 5MB limit
            'password' => 'nullable',
        ]);

        // Delete old profile image if it exists and not named "default.svg"
        if ($freelancer->image && $freelancer->image !== '/img/profile-pictures/default.svg') {
            Storage::disk('profile-pictures')->delete($freelancer->image);
        }

        // Update name and email
        $freelancer->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        // Update profile image
        if ($request->hasFile('img')) {
            $imageName = time() . '_' . $request->file('img')->getClientOriginalName();
            $path = $request->file('img')->storeAs('img/profile-pictures/', $imageName, 'public');

            $freelancer->update([
                'img' => 'storage/img/profile-pictures/' . $imageName,
            ]);
        }

        // Update password if provided
        if ($request->filled('password')) {
            $freelancer->update([
                'password' => Hash::make($request->password),
            ]);
        }

        return redirect()->route('freelancers.profile')->with('success', 'Profile updated successfully.');
    }

    function show(Request $request, $id) {
        $categories = Category::all();
        $freelancer = Freelancer::findOrFail($id);
        $bankAccount = BankAccounts::where('user_type', 'freelancer')->where('user_id', $freelancer->id)->first();
        $currentBalance = $bankAccount ? $bankAccount->current_balance : 0;

        return view("public.freelancer", [
            "categories" => $categories,
            "freelancer" => $freelancer,
            "bankAccount" => $bankAccount,
            "currentBalance" => $currentBalance
        ]);
    }

}
