<?php

namespace App\Http\Controllers\Admin\Produk;

use App\Http\Controllers\Controller;
use App\Models\Brosur;
use App\Models\ControlGenerationsProduk;
use App\Models\DocumentCertificationsProduk;
use App\Models\Kategori;
use App\Models\Produk;
use App\Models\ProdukImage;
use App\Models\ProdukVideo;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Ambil keyword pencarian dan kategori dari input pengguna
        $keyword = $request->input('search');
        $kategoriId = $request->input('kategori');

        // Query produk dengan pencarian, kategori, dan pagination
        $produks = Produk::when($keyword, function ($query) use ($keyword) {
            $query->where('nama', 'like', "%{$keyword}%")
                ->orWhere('merk', 'like', "%{$keyword}%");
        })->when($kategoriId, function ($query) use ($kategoriId) {
            $query->where('kategori_id', $kategoriId);
        })->paginate(10);

        // Ambil semua kategori untuk dropdown filter
        
        $kategori = Kategori::all();
        return view('Admin.Produk.index', compact('produks', 'kategori', 'keyword', 'kategoriId'));
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategori = Kategori::all();
        return view('Admin.Produk.create', (compact('kategori')));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'merk' => 'required|string|max:255',
            'link' => 'required|string|max:255',
            'deskripsi' => 'required',
            'spesifikasi' => 'required',
            'kategori_id' => 'required|exists:kategori,id',
            'gambar.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:15000',
            'video.*' => 'nullable|file|mimes:mp4,avi,mkv|max:50000',
            'user_manual' => 'nullable|file|mimes:pdf,doc,docx|max:20000',
            'document_certification_pdf.*' => 'nullable|file|mimes:pdf|max:20000',
            'file.*' => 'nullable|mimes:pdf,jpeg,png,jpg,gif|max:20000', // Optional for editing


        ]);

        // Create a new Produk instance and fill it with the validated data
        $produk = new Produk;
        $produk->fill($request->all());
        $produk->save();

        // Handle user manual upload
        if ($request->hasFile('user_manual')) {
            $userManualName = time() . '_' . Str::slug(pathinfo($request->file('user_manual')->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $request->file('user_manual')->getClientOriginalExtension();
            $request->file('user_manual')->move('uploads/produk/user_manual/', $userManualName);
            $produk->user_manual = 'uploads/produk/user_manual/' . $userManualName;
            $produk->save();
        }

        // Handle document certification PDF upload
        if ($request->hasFile('document_certification_pdf')) {
            foreach ($request->file('document_certification_pdf') as $file) {
                $fileName = time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();
                $file->move('uploads/produk/document_certifications/', $fileName);

                // Simpan dokumen di database
                DocumentCertificationsProduk::create([
                    'produk_id' => $produk->id,
                    'pdf' => 'uploads/produk/document_certifications/' . $fileName,
                ]);
            }
        }


        // Handle video upload
        if ($request->hasFile('video')) {
            foreach ($request->file('video') as $videoFile) {
                $slug = Str::slug(pathinfo($videoFile->getClientOriginalName(), PATHINFO_FILENAME));
                $newVideoName = time() . '_' . $slug . '.' . $videoFile->getClientOriginalExtension();
                $videoFile->move('uploads/produk/videos/', $newVideoName);

                $produkVideo = new ProdukVideo;
                $produkVideo->produk_id = $produk->id;
                $produkVideo->video = 'uploads/produk/videos/' . $newVideoName;
                $produkVideo->save();
            }
        }

        // Handle images upload
        if ($request->hasFile('gambar')) {
            foreach ($request->file('gambar') as $imgProduk) {
                $slug = Str::slug(pathinfo($imgProduk->getClientOriginalName(), PATHINFO_FILENAME));
                $newImageName = time() . '_' . $slug . '.' . $imgProduk->getClientOriginalExtension();
                $imgProduk->move('uploads/produk/', $newImageName);

                $produkImage = new ProdukImage;
                $produkImage->produk_id = $produk->id;
                $produkImage->gambar = 'uploads/produk/' . $newImageName;
                $produkImage->save();
            }
        }

        // Handle brosur update
        if ($request->hasFile('file')) {
            foreach ($request->file('file') as $file) {
                $fileName = time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();
                $type = $file->getClientOriginalExtension() === 'pdf' ? 'pdf' : 'image';
                $file->move('uploads/produk/brosur/', $fileName);

                // Simpan brosur di database
                Brosur::create([
                    'produk_id' => $produk->id,
                    'file' => 'uploads/produk/brosur/' . $fileName,
                    'type' => $type,
                ]);
            }
        }


        return redirect()->route('Admin.Produk.index')->with('success', 'Produk created successfully.');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $produk = Produk::findOrFail($id);
        $kategori = Kategori::all();
        return view('Admin.Produk.edit', compact('produk', 'kategori'));
    }

    public function show($id)
    {
        $produk = Produk::with('images', 'videos', 'documentCertificationsProduk', 'brosur')->findOrFail($id);
        return view('Admin.Produk.show', compact('produk'));
    }




    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'merk' => 'required|string|max:255',
            'link' => 'required|string|max:255',
            'deskripsi' => 'required',
            'spesifikasi' => 'required',
            'kategori_id' => 'required|exists:kategori,id',
            'gambar.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:15000',
            'video.*' => 'nullable|file|mimes:mp4,avi,mkv|max:50000',
            'user_manual' => 'nullable|file|mimes:pdf,doc,docx|max:20000',
            'document_certification_pdf.*' => 'nullable|file|mimes:pdf|max:20000',
            'file.*' => 'nullable|mimes:pdf,jpeg,png,jpg,gif|max:20000',
        ]);

        $produk = Produk::findOrFail($id);
        $produk->fill($request->all());
        $produk->save();


        if ($request->has('delete_images')) {
            $deleteImageIds = $request->input('delete_images');
            foreach ($deleteImageIds as $imageId) {
                $image = ProdukImage::find($imageId);
                if ($image) {
                    if (file_exists(public_path($image->gambar))) {
                        unlink(public_path($image->gambar));
                    }
                    $image->delete();
                }
            }
        }

        // Handle user manual upload
        if ($request->hasFile('user_manual')) {
            // Delete the old manual if exists
            if ($produk->user_manual && file_exists(public_path($produk->user_manual))) {
                unlink(public_path($produk->user_manual));
            }

            $userManualName = time() . '_' . Str::slug(pathinfo($request->file('user_manual')->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $request->file('user_manual')->getClientOriginalExtension();
            $request->file('user_manual')->move('uploads/produk/user_manual/', $userManualName);
            $produk->user_manual = 'uploads/produk/user_manual/' . $userManualName;
            $produk->save();
        }

        // Handle document certification PDF upload
        if ($request->hasFile('document_certification_pdf')) {
            // Ambil brosur lama terkait produk dan hapus file fisiknya jika diperlukan
            $oldDocumentCertifications = DocumentCertificationsProduk::where('produk_id', $produk->id)->get();

            // Menghapus semua dokumen lama
            foreach ($oldDocumentCertifications as $oldDocument) {
                if (file_exists(public_path($oldDocument->pdf))) {
                    unlink(public_path($oldDocument->pdf)); // Menghapus file dari server
                }
                $oldDocument->delete(); // Menghapus record dari database
            }

            // Upload dan simpan dokumen baru
            foreach ($request->file('document_certification_pdf') as $file) {
                $fileName = time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();
                $file->move('uploads/produk/document_certifications/', $fileName);

                // Simpan dokumen di database
                DocumentCertificationsProduk::create([
                    'produk_id' => $produk->id,
                    'pdf' => 'uploads/produk/document_certifications/' . $fileName
                ]);
            }
        }



        // Handle video upload
        if ($request->hasFile('video')) {
            foreach ($request->file('video') as $videoFile) {
                $slug = Str::slug(pathinfo($videoFile->getClientOriginalName(), PATHINFO_FILENAME));
                $newVideoName = time() . '_' . $slug . '.' . $videoFile->getClientOriginalExtension();
                $videoFile->move('uploads/produk/videos/', $newVideoName);

                $produkVideo = new ProdukVideo;
                $produkVideo->produk_id = $produk->id;
                $produkVideo->video = 'uploads/produk/videos/' . $newVideoName;
                $produkVideo->save();
            }
        }

        // Handle images upload
        if ($request->hasFile('gambar')) {
            foreach ($request->file('gambar') as $imgProduk) {
                $slug = Str::slug(pathinfo($imgProduk->getClientOriginalName(), PATHINFO_FILENAME));
                $newImageName = time() . '_' . $slug . '.' . $imgProduk->getClientOriginalExtension();
                $imgProduk->move('uploads/produk/', $newImageName);

                $produkImage = new ProdukImage;
                $produkImage->produk_id = $produk->id;
                $produkImage->gambar = 'uploads/produk/' . $newImageName;
                $produkImage->save();
            }
        }

        // Handle brosur update
        if ($request->hasFile('file')) {
            // Ambil brosur lama terkait produk
            $oldBrosur = Brosur::where('produk_id', $produk->id)->get();

            // Hapus semua file brosur lama
            foreach ($oldBrosur as $brosur) {
                if (file_exists(public_path($brosur->file))) {
                    unlink(public_path($brosur->file)); // Menghapus file fisik dari server
                }
                $brosur->delete(); // Hapus dari database
            }

            // Upload brosur baru
            foreach ($request->file('file') as $file) {
                $fileName = time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();
                $type = $file->getClientOriginalExtension() === 'pdf' ? 'pdf' : 'image';
                $file->move('uploads/produk/brosur/', $fileName);

                // Simpan brosur baru di database
                Brosur::create([
                    'produk_id' => $produk->id,
                    'file' => 'uploads/produk/brosur/' . $fileName,
                    'type' => $type
                ]);
            }
        }





        return redirect()->route('Admin.Produk.index')->with('success', 'Produk updated successfully.');
    }




    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $produk = Produk::findOrFail($id);
        $produk->delete();

        return redirect()->route('Admin.Produk.index')->with('success', 'Produk deleted successfully.');
    }

}
