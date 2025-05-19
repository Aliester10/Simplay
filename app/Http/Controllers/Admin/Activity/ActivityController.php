<?php

namespace App\Http\Controllers\Admin\Activity;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Activity;

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
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'date' => 'required|date',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $imageName = time().'.'.$request->image->extension();
        $request->image->move(public_path('images'), $imageName);

        Activity::create([
            'image' => $imageName,
            'date' => $request->date,
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return redirect()->route('Admin.Activity.index')->with('success', 'Activity created successfully.');
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
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'date' => 'required|date',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        if ($request->hasFile('image')) {
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $activity->image = $imageName;
        }

        $activity->date = $request->date;
        $activity->title = $request->title;
        $activity->description = $request->description;
        $activity->save();

        return redirect()->route('Admin.Activity.index')->with('success', 'Activity updated successfully.');
    }

    public function destroy(Activity $activity)
    {
        if (file_exists(public_path('images/'.$activity->image))) {
            unlink(public_path('images/'.$activity->image));
        }
        $activity->delete();
        return redirect()->route('Admin.Activity.index')->with('success', 'Activity deleted successfully.');
    }
}
