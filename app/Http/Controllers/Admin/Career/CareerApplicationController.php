<?php

namespace App\Http\Controllers\Admin\Career;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CareerApplication;
use App\Models\CareerPosition;

class CareerApplicationController extends Controller
{
    public function index()
    {
        $applications = CareerApplication::with('position')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        $positions = CareerPosition::all();

        return view('Admin.Career.Applications.index', compact('applications', 'positions'));
    }

    public function show(CareerApplication $application)
    {
        $application->load('position');
        return view('Admin.Career.Applications.show', compact('application'));
    }

    public function create()
    {
        $positions = CareerPosition::all();
        return view('Admin.Career.Applications.create', compact('positions'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'position_id' => 'required|exists:career_positions,id',
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:50',
            'address' => 'nullable|string|max:255',
            'cover_letter' => 'nullable|string',
            'cv' => 'required|file|mimes:pdf,doc,docx|max:2048',
            'portfolio_url' => 'nullable|url',
            'expected_salary' => 'nullable|string|max:100',
            'notice_period' => 'nullable|string|max:100',
            'linkedin_profile' => 'nullable|url',
        ]);

        if ($request->hasFile('cv')) {
            // Simpan file ke public/uploads/career
            $cvPath = $request->file('cv')->store('uploads/career', 'public');
            $validated['cv_path'] = $cvPath; // akan jadi uploads/career/nama_file.pdf
        }

        $validated['status'] = 'Pending'; // default status

        CareerApplication::create($validated);

        return redirect()->route('Admin.Career.Applications.index')
            ->with('success', 'Application submitted successfully.');
    }

    public function updateStatus(Request $request, CareerApplication $application)
    {
        $validated = $request->validate([
            'status' => 'required|string|in:Pending,Diproses,Ditolak,Diterima',
        ]);

        $application->update([
            'status' => $validated['status'],
        ]);

        return redirect()->route('Admin.Career.Applications.show', $application)
            ->with('success', 'Status updated!');
    }
    
    public function downloadCV(CareerApplication $application)
    {
        if (!$application->cv_path) {
            return redirect()->back()->with('error', 'CV file not found.');
        }

        $filePath = public_path($application->cv_path);

        if (!file_exists($filePath)) {
            return redirect()->back()->with('error', 'CV file not found on server.');
        }

        $filename = pathinfo($application->cv_path, PATHINFO_BASENAME);

        return response()->download($filePath, $filename);
    }
}