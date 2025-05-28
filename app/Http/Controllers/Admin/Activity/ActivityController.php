<?php

namespace App\Http\Controllers\Admin\Activity;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Activity;
use App\Models\ActivityImage;

class ActivityController extends Controller
{
    public function index()
    {
        $activities = Activity::all();
        return view('Admin.Activity.index', compact('activities'));
    }

    public function create()
    {
        return view('Admin.Activity.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'images' => 'required',
            'images.*' => 'image|mimes:jpeg,png,jpg|max:2048',
            'date' => 'required|date',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        // Process main image (first image)
        $mainImage = '';
        if ($request->hasFile('images') && count($request->file('images')) > 0) {
            $mainImage = time() . '_' . $request->file('images')[0]->getClientOriginalName();
            $request->file('images')[0]->move(public_path('images'), $mainImage);
        }

        // Create activity with the main image
        $activity = Activity::create([
            'image' => $mainImage,
            'date' => $request->date,
            'title' => $request->title,
            'description' => $request->description,
        ]);

        // Store additional images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $image) {
                // Skip the first image as it's already stored as the main image
                if ($index === 0) continue;
                
                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('images'), $imageName);
                
                ActivityImage::create([
                    'activity_id' => $activity->id,
                    'image' => $imageName
                ]);
            }
        }

        return redirect()->route('admin.activity.index')->with('success', 'Activity created successfully.');
    }

    public function edit(Activity $activity)
    {
        return view('Admin.Activity.edit', compact('activity'));
    }

    public function show(Activity $activity)
    {
        return view('Admin.Activity.show', compact('activity'));
    }

    public function update(Request $request, Activity $activity)
    {
        $request->validate([
            'date' => 'required|date',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'images.*' => 'image|mimes:jpeg,png,jpg|max:2048'
        ]);

        // Update activity details
        $activity->date = $request->date;
        $activity->title = $request->title;
        $activity->description = $request->description;

        // Handle main image replacement
        if ($request->has('replace_main_image') && $request->replace_main_image) {
            if ($request->hasFile('main_image')) {
                // Delete old main image
                if ($activity->image && file_exists(public_path('images/' . $activity->image))) {
                    unlink(public_path('images/' . $activity->image));
                }
                
                // Upload new main image
                $mainImage = time() . '_' . $request->file('main_image')->getClientOriginalName();
                $request->file('main_image')->move(public_path('images'), $mainImage);
                
                $activity->image = $mainImage;
            }
        }
        
        $activity->save();

        // Handle additional image uploads
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('images'), $imageName);
                
                ActivityImage::create([
                    'activity_id' => $activity->id,
                    'image' => $imageName
                ]);
            }
        }

        // Handle image deletions
        if ($request->has('delete_images')) {
            foreach ($request->delete_images as $imageId) {
                $image = ActivityImage::find($imageId);
                if ($image) {
                    if (file_exists(public_path('images/' . $image->image))) {
                        unlink(public_path('images/' . $image->image));
                    }
                    $image->delete();
                }
            }
        }

        return redirect()->route('admin.activity.index')->with('success', 'Activity updated successfully.');
    }

    public function destroy(Activity $activity)
    {
        // Delete main image
        if ($activity->image && file_exists(public_path('images/' . $activity->image))) {
            unlink(public_path('images/' . $activity->image));
        }
        
        // Delete all associated images from storage
        foreach ($activity->images as $image) {
            if (file_exists(public_path('images/' . $image->image))) {
                unlink(public_path('images/' . $image->image));
            }
        }

        $activity->delete();
        return redirect()->route('admin.activity.index')->with('success', 'Activity deleted successfully.');
    }
    
    public function deleteImage($id)
    {
        $image = ActivityImage::findOrFail($id);
        
        if (file_exists(public_path('images/' . $image->image))) {
            unlink(public_path('images/' . $image->image));
        }
        
        $image->delete();
        
        return response()->json(['success' => true]);
    }
}