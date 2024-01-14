<?php

namespace App\Http\Controllers;

use App\Models\Gig;
use App\Http\Requests\StoreGigRequest;
use App\Http\Requests\UpdateGigRequest;
use App\Models\Category;
use App\Models\Freelancer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

use function Laravel\Prompts\error;

class GigController extends Controller
{

    public function gigsDashboard(Request $request){
        $freelancer = Freelancer::find($request->freelancer->id);
        $gigs = Gig::where("freelancer_id", "=", $request->freelancer->id)->get()->sortByDesc('created_at');

        return view("freelancer.gigs.dashboard", [
            "freelancer" => $freelancer,
            "gigs" => $gigs
        ]);
    }

    public function create(Request $request){
        $freelancer = Freelancer::find($request->freelancer->id);
        $categories = Category::all();
        return view("freelancer.gigs.create", [
            "freelancer" => $freelancer,
            "categories" => $categories
        ]);
    }

    public function store(StoreGigRequest $request){
        
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'string',
            'category' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:10',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg,webp|max:5120', 
        ]);

        $gigUuid = Str::uuid();

        $gig = Gig::create([
            'freelancer_id' => $request->input('freelancer_id'), 
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'category_id' => $request->input('category'),
            'price' => $request->input('price'),
            'images' => [], // Initialize an empty array for now
            'uuid' => $gigUuid,
            'status' => "active"
        ]);

        // Handle image upload if files are present
        if ($request->hasFile('images')) {
            
            $uploadedImages = [];

            $i = 0;
            foreach ($request->file('images') as $image) {
                $imageName = $gigUuid . '_'. $i . '_' . $image->getClientOriginalName();
                $path = $image->storeAs("gig-images/{$gigUuid}", $imageName, 'public');
                $uploadedImages[] = $path;
                $i++;
            }

            $gig->update([
                'images' => $uploadedImages,
            ]);
        }

        return redirect()->route('freelancers.gigs.index')->with('success', 'Gig created successfully.');
    }

    public function edit($id, Request $request){
        $gig = Gig::findOrFail($id);
        $categories = Category::all();
        $freelancer = Freelancer::find($request->freelancer->id);
        return view('freelancer.gigs.edit', compact('gig', 'categories', 'freelancer'));
    }

    public function update(UpdateGigRequest $request, $id){
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'string',
            'category' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:10',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg,webp|max:5120',
        ]);

        $gig = Gig::findOrFail($id);

        // Handle image upload if files are present
        if ($request->hasFile('images')) {
            $uploadedImages = $gig->images ?? []; // Existing images or initialize as empty array
            $gigUuid = $gig->uuid ?? Str::uuid(); // Existing UUID or generate a new one
            $images = $request->file('images');

            foreach ($images as $index => $image) {
                
                if (!empty($uploadedImages[$index])) {
                    error_log(Storage::delete($uploadedImages[$index]));
                }

                $imageName = $gigUuid . '_' . $index . '_' . $image->getClientOriginalName();
                $path = $image->storeAs("gig-images/{$gigUuid}", $imageName, 'public');
                $uploadedImages[$index] = $path;
            }

            // Update images field
            $gig->update(['images' => $uploadedImages, 'uuid' => $gigUuid]);
        }

        // Update other fields
        $gig->update([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'category_id' => $request->input('category'),
            'price' => $request->input('price'),
            'status' => $gig->status,
        ]);

        return redirect()->route('freelancers.gigs.index')->with('success', 'Gig updated successfully.');
    }

    public function show(Gig $gig, $id){
        $gig = Gig::findOrFail($id);
        $categories = Category::all();

        return view('public.gig', [
            "gig" => $gig,
            "categories" => $categories,
        ]);
    }

    public function destroy(Gig $gig){
        // Delete the folder for images
        $isDeleted = Storage::disk('gig-images')->deleteDirectory($gig->uuid);
        // Delete the Gig record
        $gig->delete();

        return response()->json(['message' => 'Gig deleted successfully']);
    }

    public function updateStatus(Gig $gig, Request $request) {
        $request->validate([
            'status' => 'required|in:active,disabled',
        ]);
        
        $gig->update(['status' => $request->input('status')]);
        
        return response()->json(['message' => 'Gig status updated successfully']);
        return response()->json(['message' => $gig]);
    }
}
