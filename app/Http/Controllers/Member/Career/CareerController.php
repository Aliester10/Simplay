<?php

namespace App\Http\Controllers\Member\Career;

use App\Http\Controllers\Controller;
use App\Models\CareerPosition;
use App\Models\CareerApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class CareerController extends Controller
{
    /**
     * Display a listing of available career positions.
     */
    public function index(Request $request)
    {
        try {
            $query = CareerPosition::where('is_active', true);
            
            // Filter by category if provided
            if ($request->has('category') && $request->category) {
                $query->where('category', $request->category);
            }
            
            // Filter by location if provided
            if ($request->has('location') && $request->location) {
                $query->where('location', 'like', '%' . $request->location . '%');
            }
            
            // Filter by type if provided
            if ($request->has('type') && $request->type) {
                $query->where('type', $request->type);
            }
            
            // Get all available categories for filter
            $categories = CareerPosition::where('is_active', true)
                ->select('category')
                ->distinct()
                ->pluck('category');
                
            // Get all positions
            $positions = $query->orderBy('created_at', 'desc')->paginate(10);
            
            return view('Member.Career.index', compact('positions', 'categories'));
        } catch (\Exception $e) {
            Log::error('Error loading career positions: ' . $e->getMessage());
            return back()->with('error', 'Failed to load career positions. Please try again.');
        }
    }

    /**
     * Display the details of a career position.
     */
    public function show($slug)
    {
        try {
            $position = CareerPosition::where('slug', $slug)
                ->where('is_active', true)
                ->firstOrFail();
                
            // Get related positions in the same category
            $relatedPositions = CareerPosition::where('id', '!=', $position->id)
                ->where('category', $position->category)
                ->where('is_active', true)
                ->take(3)
                ->get();
                
            return view('Member.Career.show', compact('position', 'relatedPositions'));
        } catch (\Exception $e) {
            Log::error('Error loading career position: ' . $e->getMessage());
            return redirect()->route('member.career.index')
                ->with('error', 'Position not found or no longer available.');
        }
    }
    
    /**
     * Display application form for a position.
     */
    public function applyForm($slug)
    {
        try {
            $position = CareerPosition::where('slug', $slug)
                ->where('is_active', true)
                ->firstOrFail();
                
            // Check if deadline has passed
            if ($position->application_deadline && now() > $position->application_deadline) {
                return redirect()->route('member.career.show', $slug)
                    ->with('error', 'The application deadline for this position has passed.');
            }
                
            return view('Member.Career.apply', compact('position'));
        } catch (\Exception $e) {
            Log::error('Error loading application form: ' . $e->getMessage());
            return redirect()->route('member.career.index')
                ->with('error', 'Position not found or no longer available.');
        }
    }

    /**
     * Apply for a position.
     */
    public function apply(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'position_id' => 'required|exists:career_positions,id',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'cv' => 'required|file|mimes:pdf,doc,docx|max:5120', // 5MB max
            'cover_letter' => 'nullable|string',
            'linkedin_url' => 'nullable|url|max:255',
            'portfolio_url' => 'nullable|url|max:255',
        ]);
        
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        
        try {
            $position = CareerPosition::findOrFail($request->position_id);
            
            // Check if position is active
            if (!$position->is_active) {
                return back()->with('error', 'This position is no longer available.');
            }
            
            // Check if deadline has passed
            if ($position->application_deadline && now() > $position->application_deadline) {
                return back()->with('error', 'The application deadline for this position has passed.');
            }
            
            // Store CV file
            $cvPath = null;
            if ($request->hasFile('cv')) {
                $file = $request->file('cv');
                $fileName = time() . '_' . Str::slug($request->name) . '.' . $file->getClientOriginalExtension();
                $cvPath = 'uploads/careers/cv/' . $fileName;
                Storage::disk('public')->put($cvPath, file_get_contents($file));
                $cvPath = 'storage/' . $cvPath;
            }
            
            // Create application
            $application = new CareerApplication();
            $application->position_id = $position->id;
            $application->user_id = Auth::id() ?? null;
            $application->name = $request->name;
            $application->email = $request->email;
            $application->phone = $request->phone;
            $application->cv_path = $cvPath;
            $application->cover_letter = $request->cover_letter;
            $application->linkedin_url = $request->linkedin_url;
            $application->portfolio_url = $request->portfolio_url;
            $application->status = 'Pending';
            $application->save();
            
            Log::info('New career application submitted', [
                'position' => $position->title,
                'applicant' => $request->name,
                'email' => $request->email
            ]);
            
            return redirect()->route('member.career.success')
                ->with('success', 'Your application has been submitted successfully.');
        } catch (\Exception $e) {
            Log::error('Error submitting career application: ' . $e->getMessage());
            return back()->withInput()
                ->with('error', 'Failed to submit application. Please try again.');
        }
    }
    
    /**
     * Display success page after application submission.
     */
    public function success()
    {
        return view('Member.Career.success');
    }
    
    /**
     * Display listings by category.
     */
    public function category($category)
    {
        try {
            $positions = CareerPosition::where('category', $category)
                ->where('is_active', true)
                ->orderBy('created_at', 'desc')
                ->paginate(10);
                
            // Get all available categories for filter
            $categories = CareerPosition::where('is_active', true)
                ->select('category')
                ->distinct()
                ->pluck('category');
                
            return view('Member.Career.category', compact('positions', 'categories', 'category'));
        } catch (\Exception $e) {
            Log::error('Error loading category listings: ' . $e->getMessage());
            return redirect()->route('member.career.index')
                ->with('error', 'Failed to load category listings.');
        }
    }

    /**
     * Display search results.
     */
    public function search(Request $request)
    {
        $keyword = $request->input('keyword');
        
        try {
            $positions = CareerPosition::where('is_active', true)
                ->where(function($query) use ($keyword) {
                    $query->where('title', 'like', "%{$keyword}%")
                        ->orWhere('description', 'like', "%{$keyword}%")
                        ->orWhere('location', 'like', "%{$keyword}%")
                        ->orWhere('category', 'like', "%{$keyword}%");
                })
                ->orderBy('created_at', 'desc')
                ->paginate(10);
                
            // Get all available categories for filter
            $categories = CareerPosition::where('is_active', true)
                ->select('category')
                ->distinct()
                ->pluck('category');
                
            return view('Member.Career.search', compact('positions', 'categories', 'keyword'));
        } catch (\Exception $e) {
            Log::error('Error searching career positions: ' . $e->getMessage());
            return redirect()->route('member.career.index')
                ->with('error', 'Error occurred during search. Please try again.');
        }
    }
}