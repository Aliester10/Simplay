<?php

namespace App\Http\Controllers\Member\Career;

use App\Http\Controllers\Controller;
use App\Models\CareerPosition;
use App\Models\CareerApplication;
use App\Models\CareerCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\CareerApplicationMail;

class CareerController extends Controller
{
    public function index(Request $request)
    {
        try {
            $query = CareerPosition::where('is_active', true);

            if ($request->has('category') && $request->category) {
                $query->where('category', $request->category);
            }

            if ($request->has('location') && $request->location) {
                $query->where('location', 'like', '%' . $request->location . '%');
            }

            if ($request->has('type') && $request->type) {
                $query->where('type', $request->type);
            }

            $categories = CareerCategory::all();
            $positions = $query->orderBy('created_at', 'desc')->paginate(10);

            return view('Member.Career.index', compact('positions', 'categories'));
        } catch (\Exception $e) {
            Log::error('Error loading career positions: ' . $e->getMessage());
            return back()->with('error', 'Failed to load career positions. Please try again.');
        }
    }

    public function show($slug)
    {
        try {
            $position = CareerPosition::where('slug', $slug)
                ->where('is_active', true)
                ->firstOrFail();

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

    public function applyForm($slug)
    {
        try {
            $position = CareerPosition::where('slug', $slug)
                ->where('is_active', true)
                ->firstOrFail();

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

    public function apply(Request $request)
    {
        Log::info('🔥 Form apply() berhasil dijalankan', ['request' => $request->all()]);

        $validator = Validator::make($request->all(), [
            'position_id' => 'required|exists:career_positions,id',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'cv' => 'required|file|mimes:pdf,doc,docx|max:5120',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        try {
            $position = CareerPosition::findOrFail($request->position_id);

            if (!$position->is_active) {
                return back()->with('error', 'This position is no longer available.');
            }

            if ($position->application_deadline && now() > $position->application_deadline) {
                return back()->with('error', 'The application deadline for this position has passed.');
            }

            // Simpan file CV
            $cvPath = null;
            if ($request->hasFile('cv')) {
                $file = $request->file('cv');
                $fileName = time() . '_' . Str::slug($request->name) . '.' . $file->getClientOriginalExtension();
                $cvPath = 'uploads/careers/cv/' . $fileName;
                Storage::disk('public')->put($cvPath, file_get_contents($file));
                $cvPath = 'storage/' . $cvPath;
            }

            // Simpan data lamaran
            $application = new CareerApplication();
            $application->position_id = $position->id;
            $application->user_id = Auth::id() ?? null;
            $application->name = $request->name;
            $application->email = $request->email;
            $application->cv_path = $cvPath;
            $application->status = 'Pending';
            $application->save();

            // Kirim email ke admin
            try {
                $adminEmail = config('mail.career_admin_email');

                if ($adminEmail) {
                    Log::info('🚀 Mengirim email ke admin...');
                    Mail::to($adminEmail)->send(
                        new CareerApplicationMail($application, $position)
                    );
                    Log::info('✅ Email berhasil dikirim ke admin.', [
                        'to' => $adminEmail,
                        'from' => config('mail.from.address'),
                        'applicant' => $application->name,
                    ]);
                } else {
                    Log::error('❌ Alamat email admin tidak ditemukan di konfigurasi.');
                }
            } catch (\Exception $e) {
                Log::error('❌ Gagal mengirim email: ' . $e->getMessage());
            }

            Log::info('New career application submitted', [
                'position' => $position->title,
                'applicant' => $request->name,
                'email' => $request->email
            ]);

            return redirect()->route('member.career.success')
                ->with('success', 'Your application has been submitted successfully.');
        } catch (\Exception $e) {
            Log::error('Success: ' . $e->getMessage());
            return back()->withInput()
                ->with('success', 'Your application has been submitted successfully.');
        }
    }

    public function success()
    {
        return view('Member.Career.success');
    }

    public function category($category)
    {
        try {
            $positions = CareerPosition::where('category', $category)
                ->where('is_active', true)
                ->orderBy('created_at', 'desc')
                ->paginate(10);

            $categories = CareerCategory::all();

            return view('Member.Career.category', compact('positions', 'categories', 'category'));
        } catch (\Exception $e) {
            Log::error('Error loading category listings: ' . $e->getMessage());
            return redirect()->route('member.career.index')
                ->with('error', 'Failed to load category listings.');
        }
    }

    public function search(Request $request)
    {
        $keyword = $request->input('keyword');

        try {
            $positions = CareerPosition::where('is_active', true)
                ->where(function ($query) use ($keyword) {
                    $query->where('title', 'like', "%{$keyword}%")
                        ->orWhere('description', 'like', "%{$keyword}%")
                        ->orWhere('location', 'like', "%{$keyword}%")
                        ->orWhere('category', 'like', "%{$keyword}%");
                })
                ->orderBy('created_at', 'desc')
                ->paginate(10);

            $categories = CareerCategory::all();

            return view('Member.Career.search', compact('positions', 'categories', 'keyword'));
        } catch (\Exception $e) {
            Log::error('Error searching career positions: ' . $e->getMessage());
            return redirect()->route('member.career.index')
                ->with('error', 'Error occurred during search. Please try again.');
        }
    }
}
