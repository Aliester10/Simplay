<?php
namespace App\Http\Controllers\Admin\Distributor;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
class DistributorApprovalController extends Controller
{
    public function show($id)
    {
        // Find the distributor by ID
        $distributor = User::findOrFail($id);
        // Pass the distributor to the view
        return view('Admin.Distributors.show', compact('distributor'));
    }
    public function index(Request $request)
    {
        // Membuat query untuk distributor dengan type '2'
        $query = User::where('type', '2'); // Hanya pengguna dengan tipe distributor

        // Pencarian berdasarkan nama, email, atau nama perusahaan jika parameter 'search' ada
        if ($request->has('search') && $request->search !== null) {
            $search = $request->input('search');

            // Pencarian berdasarkan field tertentu
            if ($request->has('search_by') && in_array($request->input('search_by'), ['name', 'email', 'nama_perusahaan'])) {
                $searchBy = $request->input('search_by');

                // Jika field pencarian adalah 'name'
                if ($searchBy == 'name') {
                    $query->where('name', 'like', "%{$search}%");
                }
                // Jika field pencarian adalah 'email'
                elseif ($searchBy == 'email') {
                    $query->where('email', 'like', "%{$search}%");
                }
                // Jika field pencarian adalah 'nama_perusahaan'
                elseif ($searchBy == 'nama_perusahaan') {
                    $query->where('nama_perusahaan', 'like', "%{$search}%");
                }
            } else {
                // Jika tidak ada filter khusus, lakukan pencarian di semua field (name, email, nama_perusahaan)
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%")
                        ->orWhere('nama_perusahaan', 'like', "%{$search}%");
                });
            }
        }

        // Menambahkan pagination (10 data per halaman)
        $distributors = $query->paginate(10);

        // Mengirim data ke view
        return view('Admin.Distributors.index', compact('distributors'));
    }

    public function approve($id)
    {
        $user = User::findOrFail($id);
        $user->verified = true;
        $user->save();
        return redirect()->route('Admin.Distributors.index')->with('success', 'Distributor approved successfully.');
    }
}