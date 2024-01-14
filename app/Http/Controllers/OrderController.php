<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\Category;
use App\Models\Company;
use App\Models\Gig;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    public function index(Request $request){
        $company = Company::find($request->company->id);

        return view("company.orders.index", [
            "company" => $company,
            "orders" => $company->orders,
        ]);
    }

    public function create($gigId){
        $categories = Category::all();
        $gig = Gig::find($gigId);

        return view("company.orders.create", [
            "categories" => $categories,
            "gig" => $gig,
        ]);

    }

    public function store(StoreOrderRequest $request){
        $validatedData = $request->validate([
            'freelancer_id' => 'required|exists:freelancers,id',
            'company_id' => 'required|exists:companies,id',
            'gig_id' => 'required|exists:gigs,id',
            'description' => 'string',
            'amount' => 'required|numeric',
            'time' => 'required|integer',
        ]);

        $validatedData['status'] = 'pending';
        $validatedData['number'] = rand(10000000, 99999999);

        Order::create($validatedData);

        return redirect()->route('companies.orders.index')->with('success', 'Order Placed Successfully');
    }

    public function show(Order $order, $id, Request $request)
    {
        $order = Order::find($id);
        $company = Company::find($request->company->id);

        return view("company.orders.show", [
            "company" => $company,
            "order" => $order
        ]);
    }

    public function edit(Order $order)
    {
        //
    }

    public function update(UpdateOrderRequest $request, Order $order)
    {
        //
    }

    public function destroy(Order $order, Request $request, $id){
        $order = Order::find($id);
        $order->delete();

        return redirect()->route('companies.orders.index')->with('success', 'Order deleted successfully');
    }

    public function updateStatus(Order $order, $newStatus)
    {
        // Validate the new status (optional, depending on your needs)
        $allowedStatuses = ['cancelled', 'completed', 'pending'];
        if (!in_array($newStatus, $allowedStatuses)) {
            return response()->json(['error' => 'Invalid status'], 400);
        }

        // Update the status
        $order->update(['status' => $newStatus]);

        return response()->json(['message' => 'Status updated successfully']);
    }
}
