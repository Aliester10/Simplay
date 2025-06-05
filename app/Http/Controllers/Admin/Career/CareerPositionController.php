<?php

namespace App\Http\Controllers\Admin\Career;

use App\Http\Controllers\Controller;
use App\Models\CareerPosition;
use App\Models\CareerApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class CareerPositionController extends Controller
{
    /**
     * Display career dashboard/overview.
     */
    public function dashboard()
    {
        try {
            $totalPositions = CareerPosition::count();
            $activePositions = CareerPosition::where('is_active', true)->count();
            $totalApplications = CareerApplication::count();
            $pendingApplications = CareerApplication::where('status', 'Pending')->count();
            
            $recentPositions = CareerPosition::orderBy('created_at', 'desc')->take(5)->get();
            $recentApplications = CareerApplication::with('position')->orderBy('created_at', 'desc')->take(5)->get();

            return view('Admin.Career.Dashboard', compact(
                'totalPositions',
                'activePositions',
                'totalApplications',
                'pendingApplications',
                'recentPositions',
                'recentApplications'
            ));
        } catch (\Exception $e) {
            Log::error('Error loading career dashboard: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to load career dashboard.');
        }
    }

    /**
     * Display a listing of career positions.
     */
    public function index()
    {
        try {
            $positions = CareerPosition::withCount('applications')
                                    ->orderBy('created_at', 'desc')
                                    ->paginate(10);
            
            // Debug: Log position data to check category field
            foreach($positions as $position) {
                Log::info('Position in index:', [
                    'id' => $position->id,
                    'title' => $position->title,
                    'category' => $position->category
                ]);
            }
            
            return view('Admin.Career.Positions.index', compact('positions'));
        } catch (\Exception $e) {
            Log::error('Error loading career positions: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to load career positions.');
        }
    }

    /**
     * Show the form for creating a new position.
     */
    public function create()
    {
        return view('Admin.Career.Positions.create');
    }

    /**
     * Store a newly created position.
     */
    public function store(Request $request)
    {
        // Debug: Log raw request data
        Log::info('Raw store request data:', $request->all());
        
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:50',
            'location' => 'required|string|max:255',
            'type' => 'required|string|max:50',
            'description' => 'required|string',
            'requirements' => 'required|string',
            'responsibilities' => 'required|string',
            'benefits' => 'nullable|string',
            'salary_range' => 'nullable|string|max:100',
            'application_deadline' => 'nullable|date|after:today',
        ], [
            'title.required' => 'Position title is required.',
            'category.required' => 'Category is required.',
            'location.required' => 'Location is required.',
            'type.required' => 'Employment type is required.',
            'description.required' => 'Job description is required.',
            'requirements.required' => 'Requirements are required.',
            'responsibilities.required' => 'Responsibilities are required.',
            'application_deadline.after' => 'Application deadline must be in the future.',
        ]);

        try {
            // Debug: Log validated data
            Log::info('Validated store data:', $validated);
            
            $validated['slug'] = Str::slug($validated['title']) . '-' . time();
            $validated['is_active'] = $request->has('is_active');

            // Create position using manual approach to ensure all fields are set
            $position = new CareerPosition();
            $position->title = $validated['title'];
            $position->category = $validated['category'];
            $position->location = $validated['location'];
            $position->type = $validated['type'];
            $position->description = $validated['description'];
            $position->requirements = $validated['requirements'];
            $position->responsibilities = $validated['responsibilities'];
            $position->benefits = $validated['benefits'] ?? null;
            $position->salary_range = $validated['salary_range'] ?? null;
            $position->application_deadline = $validated['application_deadline'] ?? null;
            $position->slug = $validated['slug'];
            $position->is_active = $validated['is_active'];
            $position->save();
            
            // Debug: Log created position
            Log::info('Created position:', [
                'id' => $position->id,
                'title' => $position->title,
                'category' => $position->category
            ]);
            
            Log::info('New career position created', [
                'title' => $validated['title'],
                'category' => $validated['category'],
                'created_by' => auth()->user()->name ?? 'System'
            ]);
            
            return redirect()->route('Admin.Career.Positions.index')
                ->with('success', 'Position created successfully.');
        } catch (\Exception $e) {
            Log::error('Error creating career position: ' . $e->getMessage());
            Log::error('Error trace: ' . $e->getTraceAsString());
            return back()->withInput()
                ->with('error', 'Failed to create position. Please try again.');
        }
    }

    /**
     * Display the specified position.
     */
    public function show($id)
    {
        try {
            $position = CareerPosition::withCount('applications')->findOrFail($id);
            
            // Debug: Log position details
            Log::info('Position in show:', [
                'id' => $position->id,
                'title' => $position->title,
                'category' => $position->category
            ]);
            
            $applications = $position->applications()->orderBy('created_at', 'desc')->paginate(10);
            
            return view('Admin.Career.Positions.show', compact('position', 'applications'));
        } catch (\Exception $e) {
            Log::error('Error loading career position: ' . $e->getMessage());
            return redirect()->route('Admin.Career.Positions.index')
                ->with('error', 'Position not found.');
        }
    }

    /**
     * Show the form for editing the specified position.
     */
    public function edit($id)
    {
        try {
            $position = CareerPosition::findOrFail($id);
            
            // Debug: Log position data
            Log::info('Position in edit:', [
                'id' => $position->id,
                'title' => $position->title,
                'category' => $position->category
            ]);
            
            return view('Admin.Career.Positions.edit', compact('position'));
        } catch (\Exception $e) {
            Log::error('Error loading career position for edit: ' . $e->getMessage());
            return redirect()->route('Admin.Career.Positions.index')
                ->with('error', 'Position not found.');
        }
    }

    /**
     * Update the specified position.
     */
    public function update(Request $request, $id)
    {
        // Debug: Log raw request data
        Log::info('Raw update request data:', $request->all());
        
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:50',
            'location' => 'required|string|max:255',
            'type' => 'required|string|max:50',
            'description' => 'required|string',
            'requirements' => 'required|string',
            'responsibilities' => 'required|string',
            'benefits' => 'nullable|string',
            'salary_range' => 'nullable|string|max:100',
            'application_deadline' => 'nullable|date',
        ], [
            'title.required' => 'Position title is required.',
            'category.required' => 'Category is required.',
            'location.required' => 'Location is required.',
            'type.required' => 'Employment type is required.',
            'description.required' => 'Job description is required.',
            'requirements.required' => 'Requirements are required.',
            'responsibilities.required' => 'Responsibilities are required.',
        ]);

        try {
            // Debug: Log validated data
            Log::info('Validated update data:', $validated);
            
            $position = CareerPosition::findOrFail($id);
            
            // Debug: Log position before update
            Log::info('Position before update:', [
                'id' => $position->id,
                'title' => $position->title,
                'category' => $position->category
            ]);
            
            $validated['is_active'] = $request->has('is_active');
            
            // Update position using manual approach to ensure all fields are set
            $position->title = $validated['title'];
            $position->category = $validated['category'];
            $position->location = $validated['location'];
            $position->type = $validated['type'];
            $position->description = $validated['description'];
            $position->requirements = $validated['requirements'];
            $position->responsibilities = $validated['responsibilities'];
            $position->benefits = $validated['benefits'] ?? null;
            $position->salary_range = $validated['salary_range'] ?? null;
            $position->application_deadline = $validated['application_deadline'] ?? null;
            $position->is_active = $validated['is_active'];
            $position->save();
            
            // Refresh position from database to check update
            $position = $position->fresh();
            
            // Debug: Log position after update
            Log::info('Position after update:', [
                'id' => $position->id,
                'title' => $position->title,
                'category' => $position->category
            ]);
            
            Log::info('Career position updated', [
                'id' => $id,
                'title' => $validated['title'],
                'category' => $validated['category'],
                'updated_by' => auth()->user()->name ?? 'System'
            ]);
            
            return redirect()->route('Admin.Career.Positions.index')
                ->with('success', 'Position updated successfully.');
        } catch (\Exception $e) {
            Log::error('Error updating career position: ' . $e->getMessage());
            Log::error('Error trace: ' . $e->getTraceAsString());
            return back()->withInput()
                ->with('error', 'Failed to update position. Please try again.');
        }
    }

    /**
     * Remove the specified position.
     */
    public function destroy($id)
    {
        try {
            $position = CareerPosition::findOrFail($id);
            
            // Delete related applications and their CV files
            foreach ($position->applications as $application) {
                if ($application->cv_path && file_exists(public_path($application->cv_path))) {
                    unlink(public_path($application->cv_path));
                }
            }
            
            $positionTitle = $position->title;
            $position->delete();
            
            Log::info('Career position deleted', [
                'id' => $id,
                'title' => $positionTitle,
                'deleted_by' => auth()->user()->name ?? 'System'
            ]);
            
            return redirect()->route('Admin.Career.Positions.index')
                ->with('success', 'Position deleted successfully.');
        } catch (\Exception $e) {
            Log::error('Error deleting career position: ' . $e->getMessage());
            return back()->with('error', 'Failed to delete position. Please try again.');
        }
    }

    /**
     * Toggle position status.
     */
    public function toggleStatus($id)
    {
        try {
            $position = CareerPosition::findOrFail($id);
            $position->is_active = !$position->is_active;
            $position->save();

            $status = $position->is_active ? 'activated' : 'deactivated';
            
            Log::info('Career position status changed', [
                'id' => $id,
                'title' => $position->title,
                'new_status' => $status,
                'changed_by' => auth()->user()->name ?? 'System'
            ]);
            
            return redirect()->route('Admin.Career.Positions.index')
                ->with('success', "Position {$status} successfully.");
        } catch (\Exception $e) {
            Log::error('Error toggling career position status: ' . $e->getMessage());
            return back()->with('error', 'Failed to update position status. Please try again.');
        }
    }
}