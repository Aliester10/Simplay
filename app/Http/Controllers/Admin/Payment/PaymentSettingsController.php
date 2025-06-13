<?php

namespace App\Http\Controllers\Admin\Payment;

use App\Http\Controllers\Controller;
use App\Models\PaymentSetting;
use App\Models\QrisImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PaymentSettingsController extends Controller
{
    public function index()
    {
        $paymentSettings = PaymentSetting::getActiveSettings();
        $qrisImages = QrisImage::getActiveImages();
        
        return view('Admin.Payment.settings.index', compact('paymentSettings', 'qrisImages'));
    }

    public function edit()
    {
        $paymentSettings = PaymentSetting::getActiveSettings();
        if (!$paymentSettings) {
            $paymentSettings = new PaymentSetting();
        }
        
        return view('Admin.Payment.settings.edit', compact('paymentSettings'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'bank_name' => 'required|string|max:255',
            'account_number' => 'required|string|max:255',
            'account_name' => 'required|string|max:255',
            'payment_instructions' => 'nullable|string',
            'status' => 'required|in:active,inactive',
            'qr_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $settings = PaymentSetting::getActiveSettings();
        
        $data = $request->only(['bank_name', 'account_number', 'account_name', 'payment_instructions', 'status']);
        
        // Handle QR image upload sebagai BLOB
        if ($request->hasFile('qr_image')) {
            $file = $request->file('qr_image');
            $data['qr_img'] = file_get_contents($file->getRealPath());
            $data['qr_image'] = true; // Set flag to true
        }
        
        if ($settings) {
            $settings->update($data);
            $message = 'Pengaturan payment berhasil diupdate.';
        } else {
            PaymentSetting::create($data);
            $message = 'Pengaturan payment berhasil dibuat.';
        }

        return redirect()->route('Admin.Payment.settings.index')
                        ->with('success', $message);
    }

    public function uploadQris(Request $request)
    {
        $request->validate([
            'qris_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'qris_name' => 'required|string|max:255'
        ]);

        try {
            if ($request->hasFile('qris_image')) {
                // Deactivate other QR images first
                QrisImage::where('status', 'active')->update(['status' => 'inactive']);
                
                $file = $request->file('qris_image');
                $filename = time() . '_' . $file->getClientOriginalName();
                $path = $file->storeAs('qr-codes', $filename, 'public');

                QrisImage::create([
                    'name' => $request->qris_name,
                    'image_path' => $path,
                    'filename' => $filename,
                    'status' => 'active'
                ]);

                // Update PaymentSetting to enable QR
                $paymentSetting = PaymentSetting::getActiveSettings();
                if ($paymentSetting) {
                    $paymentSetting->update(['qr_image' => true]);
                }

                return redirect()->route('Admin.Payment.settings.index')
                                ->with('success', 'QR Code berhasil diupload.');
            }
        } catch (\Exception $e) {
            return redirect()->back()
                            ->with('error', 'Terjadi kesalahan saat upload QR Code: ' . $e->getMessage());
        }

        return redirect()->back()->with('error', 'File tidak ditemukan.');
    }

    public function deleteQris($id)
    {
        try {
            $qris = QrisImage::findOrFail($id);
            
            if (Storage::disk('public')->exists($qris->image_path)) {
                Storage::disk('public')->delete($qris->image_path);
            }
            
            $qris->delete();

            // Check if no more active QR images exist
            if (!QrisImage::where('status', 'active')->exists()) {
                $paymentSetting = PaymentSetting::getActiveSettings();
                if ($paymentSetting) {
                    $paymentSetting->update(['qr_image' => false]);
                }
            }

            return redirect()->route('Admin.Payment.settings.index')
                            ->with('success', 'QR Code berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()
                            ->with('error', 'Terjadi kesalahan saat menghapus QR Code: ' . $e->getMessage());
        }
    }
}