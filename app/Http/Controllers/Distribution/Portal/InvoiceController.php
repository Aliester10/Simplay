<?php
namespace App\Http\Controllers\Distribution\Portal;
use App\Http\Controllers\Controller;
use App\Models\Invoice;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
class InvoiceController extends Controller
{
    public function index(Request $request)
    {
        // Ambil ID pengguna yang sedang login (distributor)
        $userId = Auth::id();

        $invoiceNumber = $request->input('invoice_number');
        $invoiceDate = $request->input('invoice_date');

        $invoices = Invoice::whereHas('proformaInvoice.purchaseOrder', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        })
        ->with(['proformaInvoice', 'purchaseOrder'])
        ->when($invoiceNumber, function ($query) use ($invoiceNumber) {
            $query->where('invoice_number', 'like', "%{$invoiceNumber}%");
        })
        ->when($invoiceDate, function ($query) use ($invoiceDate) {
            $query->whereDate('invoice_date', $invoiceDate);
        })
        ->paginate(10); 

        return view('Distributor.Portal.Invoices.index', compact('invoices', 'invoiceNumber', 'invoiceDate'));
    }

    
}