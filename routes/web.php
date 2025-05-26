<?php

use App\Http\Controllers\Admin\MasterData\BidangPerusahaanController;
use App\Http\Controllers\Admin\MasterData\KategoriController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\Member\MemberController;
use App\Http\Controllers\Admin\FAQ\FAQController;
use App\Http\Controllers\Admin\Parameter\CompanyParameterController;
use App\Http\Controllers\Admin\Produk\ProdukController;
use App\Http\Controllers\Member\Portal\PortalController;
use App\Http\Controllers\Member\Produk\ProdukMemberController;
use App\Http\Controllers\Admin\Slider\SliderController;
use App\Http\Controllers\Admin\Activity\ActivityController;
use App\Http\Controllers\Admin\Admin\AdminController;
use App\Http\Controllers\Member\Activity\ActivityMemberController;
use App\Http\Controllers\Admin\BrandPartner\BrandPartnerController;
use App\Http\Controllers\Admin\Meta\MetaController;
use App\Http\Controllers\Member\Meta\MetaMemberController;
use App\Http\Controllers\Member\Profile\ProfileMemberController;
use App\Http\Controllers\Admin\Location\LocationController;
use App\Http\Controllers\Admin\Visitor\VisitorController;
use App\Http\Controllers\Member\Location\LocationMemberController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Http\Controllers\Member\ContactMenu\ContactMenuController;
use App\Http\Controllers\Member\Brand\BrandController;
use App\Http\Controllers\Admin\QnaGuest\QnaGuestController;
use App\Http\Controllers\Guest\Message\GuestMessageController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\Admin\Ticket\TicketController;
use App\Http\Controllers\Member\Ticket\TicketMemberController;
use App\Http\Controllers\Admin\Distributor\DistributorApprovalController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Distribution\Portal\TicketDistributorController;
use App\Http\Controllers\Distribution\Portal\QuotationController;
use App\Http\Controllers\Admin\Quotation\QuotationAdminController;
use App\Http\Controllers\Admin\Quotation\QuotationNegotiationController;
use App\Http\Controllers\Distribution\Portal\DistributorQuotationNegotiationController;
use App\Http\Controllers\Distribution\Portal\PurchaseOrderController;
use App\Http\Controllers\Admin\Invoice\InvoiceAdminController;
use App\Http\Controllers\Admin\ProformaInvoice\ProformaInvoiceAdminController;
use App\Http\Controllers\Admin\PurchaseOrder\PurchaseOrderAdminController;
use App\Http\Controllers\Distribution\Portal\DistributionController;
use App\Http\Controllers\Distribution\Portal\InvoiceController;
use App\Http\Controllers\Distribution\Portal\ProformaInvoiceDistributorController;
use App\Http\Controllers\Distribution\Profile\ProfileDistributorController;
use App\Http\Controllers\CartController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'user-access:admin'])->prefix('admin/meta')->name('Admin.Meta.')->group(function () {
    Route::get('/', [MetaController::class, 'index'])->name('index');
    Route::get('/create', [MetaController::class, 'create'])->name('create');
    Route::post('/', [MetaController::class, 'store'])->name('store');
    Route::get('/{slug}', [MetaController::class, 'show'])->name('show');
    Route::get('/{id}/edit', [MetaController::class, 'edit'])->name('edit');
    Route::put('/{id}', [MetaController::class, 'update'])->name('update');
    Route::delete('/{id}', [MetaController::class, 'destroy'])->name('destroy');
});

Route::middleware(['auth', 'user-access:admin'])->prefix('admin/slider')->name('Admin.Slider.')->group(function () {
    Route::get('/', [SliderController::class, 'index'])->name('index');
    Route::get('/create', [SliderController::class, 'create'])->name('create');
    Route::post('/', [SliderController::class, 'store'])->name('store');
    Route::get('/{slug}', [SliderController::class, 'show'])->name('show');
    Route::get('/{id}/edit', [SliderController::class, 'edit'])->name('edit');
    Route::put('/{id}', [SliderController::class, 'update'])->name('update');
    Route::delete('/{id}', [SliderController::class, 'destroy'])->name('destroy');
});

Route::middleware(['auth', 'user-access:admin'])->prefix('admin/activity')->name('Admin.Activity.')->group(function () {
    Route::get('/', [ActivityController::class, 'index'])->name('index');
    Route::get('/create', [ActivityController::class, 'create'])->name('create');
    Route::post('/', [ActivityController::class, 'store'])->name('store');
    Route::get('/{slug}', [ActivityController::class, 'show'])->name('show');
    Route::get('/{id}/edit', [ActivityController::class, 'edit'])->name('edit');
    Route::put('/{id}', [ActivityController::class, 'update'])->name('update');
    Route::delete('/{id}', [ActivityController::class, 'destroy'])->name('destroy');
});

Route::middleware(['auth', 'user-access:admin'])->prefix('admin/brand')->name('Admin.Brand.')->group(function () {
    Route::get('/', [BrandPartnerController::class, 'index'])->name('index');
    Route::get('/create', [BrandPartnerController::class, 'create'])->name('create');
    Route::post('/', [BrandPartnerController::class, 'store'])->name('store');
    Route::get('/{slug}', [BrandPartnerController::class, 'show'])->name('show');
    Route::get('/{id}/edit', [BrandPartnerController::class, 'edit'])->name('edit');
    Route::put('/{id}', [BrandPartnerController::class, 'update'])->name('update');
    Route::delete('/{id}', [BrandPartnerController::class, 'destroy'])->name('destroy');
});

Route::middleware(['auth', 'user-access:admin'])->prefix('admin/location')->name('Admin.Location.')->group(function () {
    Route::get('/', [LocationController::class, 'index'])->name('index');
    Route::get('/create', [LocationController::class, 'create'])->name('create');
    Route::post('/', [LocationController::class, 'store'])->name('store');
    Route::get('/{slug}', [LocationController::class, 'show'])->name('show');
    Route::get('/{id}/edit', [LocationController::class, 'edit'])->name('edit');
    Route::put('/{id}', [LocationController::class, 'update'])->name('update');
    Route::delete('/{id}', [LocationController::class, 'destroy'])->name('destroy');
});

Route::middleware(['auth', 'user-access:admin'])->prefix('admin/faq')->name('Admin.Faq.')->group(function () {
    Route::get('/', [FAQController::class, 'index'])->name('index');
    Route::get('/create', [FAQController::class, 'create'])->name('create');
    Route::post('/', [FAQController::class, 'store'])->name('store');
    Route::get('/{faq_id}', [FAQController::class, 'show'])->name('show');
    Route::get('/{faq_id}/edit', [FAQController::class, 'edit'])->name('edit');
    Route::put('/{faq_id}', [FAQController::class, 'update'])->name('update');
    Route::delete('/{faq_id}', [FAQController::class, 'destroy'])->name('destroy');
});


Route::prefix('id/admin')->middleware(['auth', 'user-access:admin'])->group(function () {
    Route::get('/admin/produk', [ProdukController::class, 'index'])->name('Admin.Produk.index');
    Route::get('/admin/produk/create', [ProdukController::class, 'create'])->name('Admin.Produk.create');
    Route::post('/admin/produk', [ProdukController::class, 'store'])->name('Admin.Produk.store');
    Route::get('/admin/produk/{produk}/edit', [ProdukController::class, 'edit'])->name('Admin.Produk.edit');
    Route::put('/admin/produk/{produk}', [ProdukController::class, 'update'])->name('Admin.Produk.update');
    Route::delete('/admin/produk/{produk}', [ProdukController::class, 'destroy'])->name('Admin.Produk.destroy');
});


// Guest Routes (No Authentication Required)
Route::group(['prefix' => LaravelLocalization::setLocale()], function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/about', [HomeController::class, 'about'])->name('about');
    // Rute lainnya
    Route::get('/products', [ProdukMemberController::class, 'index'])->name('product.index');
    Route::get('/products/category/{id}', [ProdukMemberController::class, 'index'])->name('product.category');
    Route::get('/product/{id}', [ProdukMemberController::class, 'show'])->name('product.show');
    Route::get('/products/filter/{id}', [ProdukMemberController::class, 'filterByCategory'])->name('filterByCategory');
    Route::get('/products/search', [ProdukMemberController::class, 'search'])->name('products.search');
    Route::post('/products/search/store', [ProdukMemberController::class, 'search'])->name('products.search.store');
    Route::get('/activity', [ActivityMemberController::class, 'activity'])->name('activity');
    Route::get('/activities/{activity}', [ActivityMemberController::class, 'show'])->name('activity.show');
    Route::get('/member/meta/{slug}', [MetaMemberController::class, 'showMetaBySlug'])->name('member.meta.show');
    Route::get('/member/meta', [MetaMemberController::class, 'showMeta'])->name('member.meta.index');
    Route::get('/locations', [LocationMemberController::class, 'index']);
    Route::get('/contact', [ContactMenuController::class, 'index'])->name('contact');
    Route::post('/contact', [ContactMenuController::class, 'store']);
    Route::get('/brands', [BrandController::class, 'index']);
    Route::get('/admin/guest-messages', [GuestMessageController::class, 'index'])->name('admin.guest-messages.index');
    Route::post('/guest-messages', [GuestMessageController::class, 'store'])->name('guest-messages.store');

    // Distributor Registration - Perbaikan rute distributor
    Route::get('/distributors/register', [RegisterController::class, 'showDistributorRegistrationForm'])->name('distributors.register');
    Route::post('/distributors/register', [RegisterController::class, 'registerDistributor'])->name('distributors.register.submit');
    Route::get('/distributors/waiting', function () {
        return view('auth.distributor_waiting');
    })->name('distributors.waiting');

    // Admin Qna Guest
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::resource('qnaguest', QnaGuestController::class);
    });

    // Menonaktifkan register default dari Auth::routes() dan hanya menggunakan yang lainnya
    Auth::routes(['register' => false]);
    
    // Redirect dari /register ke halaman distributor register
    Route::get('/register', function () {
        return redirect()->route('distributors.register');
    });

    // Rute Cart untuk Semua Pengguna
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
    Route::post('/cart/update', [CartController::class, 'updateCart'])->name('cart.update');
    Route::post('/cart/remove', [CartController::class, 'removeFromCart'])->name('cart.remove');
});


// Member Routes (Authenticated Users with "member" role)
Route::middleware(['auth', 'user-access:member'])->group(function () {
    Route::group(['prefix' => LaravelLocalization::setLocale()], function () {
        Route::get('/portal', [PortalController::class, 'index'])->name('portal');
        Route::get('/portal/user-product', [PortalController::class, 'UserProduk'])->name('portal.user-product');
        Route::get('/product/user-product/{id}', [PortalController::class, 'detailProduk'])->name('user-product.show');
        Route::get('/portal/photos', [PortalController::class, 'photos'])->name('portal.photos');
        Route::get('/portal/instructions', [PortalController::class, 'instructions'])->name('portal.instructions');
        Route::get('/portal/tutorials', [PortalController::class, 'videos'])->name('portal.tutorials');
        Route::get('/portal/controlgenerations', [PortalController::class, 'ControllerGenerations'])->name('portal.controlgenerations');
        Route::get('/portal/document', [PortalController::class, 'document'])->name('portal.document');
        Route::get('/portal/qna', [PortalController::class, 'Faq'])->name('portal.qna');
        
        // Member cart routes
        Route::get('/portal/cart', [PortalController::class, 'cart'])->name('portal.cart');
        Route::post('/portal/cart/add', [PortalController::class, 'addToCart'])->name('member.cart.add');
        Route::put('/portal/cart/update', [PortalController::class, 'updateCart'])->name('member.cart.update');
        Route::delete('/portal/cart/remove', [PortalController::class, 'removeFromCart'])->name('member.cart.remove');
        Route::post('/portal/order/submit', [PortalController::class, 'submitOrder'])->name('member.order.submit');

        Route::get('/portal/tickets', [TicketMemberController::class, 'index'])->name('tickets.index');
        Route::get('/portal/tickets/create', [TicketMemberController::class, 'create'])->name('tickets.create');
        Route::post('/portal/tickets', [TicketMemberController::class, 'store'])->name('tickets.store');
        Route::get('/portal/tickets/{id}', [TicketMemberController::class, 'show'])->name('tickets.show');
        Route::get('/portal/tickets/{id}/edit', [TicketMemberController::class, 'edit'])->name('tickets.edit');
        Route::put('/portal/tickets/{id}/cancel', [TicketMemberController::class, 'cancel'])->name('tickets.cancel');
        Route::put('/portal/tickets/{id}', [TicketMemberController::class, 'update'])->name('tickets.update');

        Route::get('/profile', [ProfileMemberController::class, 'show'])->name('profile.show');
        Route::get('/profile/edit', [ProfileMemberController::class, 'edit'])->name('profile.edit');
        Route::put('/profile/update', [ProfileMemberController::class, 'update'])->name('profile.update');
    });
});

// Distributor Routes (Authenticated Users with "distributor" role)
Route::middleware(['auth', 'user-access:distributor'])->group(function () {
    Route::group(['prefix' => LaravelLocalization::setLocale()], function () {
        Route::get('/portal/distribution', [DistributionController::class, 'index'])->name('distribution');
        Route::get('/portal/distribution/request-quotation', [DistributionController::class, 'requestQuotation'])->name('distribution.request-quotation');
        Route::get('/portal/distribution/create-po', [DistributionController::class, 'createPO'])->name('distribution.create-po');
        Route::get('/portal/distribution/invoices', [DistributionController::class, 'invoices'])->name('distribution.invoices');
        // Routes for Distributor Ticketing Service
        Route::get('/portal/distribution/tickets', [TicketDistributorController::class, 'index'])->name('distribution.tickets.index');
        Route::get('/portal/distribution/tickets/create', [TicketDistributorController::class, 'create'])->name('distribution.tickets.create');
        Route::post('/portal/distribution/tickets', [TicketDistributorController::class, 'store'])->name('distribution.tickets.store');
        Route::get('/portal/distribution/tickets/{id}', [TicketDistributorController::class, 'show'])->name('distribution.tickets.show');
        Route::get('/portal/distribution/tickets/{id}/edit', [TicketDistributorController::class, 'edit'])->name('distribution.tickets.edit');
        Route::put('/portal/distribution/tickets/{id}/cancel', [TicketDistributorController::class, 'cancel'])->name('distribution.tickets.cancel');
        Route::put('/portal/distribution/tickets/{id}', [TicketDistributorController::class, 'update'])->name('distribution.tickets.update');
        Route::post('/portal/distribution/product/{id}/add-to-quotation', [ProdukMemberController::class, 'addToQuotation'])->name('Distributor.product.addToQuotation');

        // Menampilkan halaman keranjang quotation
        Route::get('/quotations/cart', [QuotationController::class, 'cart'])->name('quotations.cart');
        // Menambahkan produk ke keranjang
        Route::post('/quotations/add-to-cart', [QuotationController::class, 'addToCart'])->name('quotations.add_to_cart');
        // Mengirim permintaan quotation dari keranjang
        Route::post('/quotations/submit', [QuotationController::class, 'submitCart'])->name('quotations.submit');
        // Update quantity di keranjang
        Route::put('/quotations/update-cart', [QuotationController::class, 'updateCart'])->name('quotations.cart.update');
        // Hapus item dari keranjang
        Route::delete('/quotations/remove-from-cart', [QuotationController::class, 'removeFromCart'])->name('quotations.cart.remove');
        // Rute untuk negosiasi quotation
        Route::get('/quotations/{id}/nego', [QuotationController::class, 'nego'])->name('quotations.nego');


        // Route untuk menampilkan form negosiasi
        Route::get('/distributor/quotations/{quotationId}/negotiation', [DistributorQuotationNegotiationController::class, 'create'])->name('distributor.quotations.negotiations.create');

        // Route untuk menampilkan form negosiasi
        Route::get('/distributor/quotations/{quotationId}/negotiation', [DistributorQuotationNegotiationController::class, 'create'])->name('distributor.quotations.negotiations.create');

        // Route untuk menyimpan negosiasi
        Route::post('/distributor/quotations/{quotationId}/negotiation', [DistributorQuotationNegotiationController::class, 'store'])->name('distributor.quotations.negotiations.store');
        Route::get('/distributor/quotations/negotiations', [DistributorQuotationNegotiationController::class, 'index'])->name('distributor.quotations.negotiations.index');
        Route::get('/proforma-invoices', [ProformaInvoiceDistributorController::class, 'index'])->name('distributor.proforma-invoices.index');
        Route::post('/distributor/proforma-invoices/{id}/upload', [ProformaInvoiceDistributorController::class, 'uploadPaymentProof'])->name('distributor.proforma-invoices.upload');
        Route::get('/proforma-invoices/{id}', [ProformaInvoiceDistributorController::class, 'show'])->name('distributor.proforma-invoices.show');

        Route::get('/distributor/invoices', [InvoiceController::class, 'index'])->name('distributor.invoices.index');


        // Quotation Routes
        Route::get('/portal/distribution/quotations/{id}', [QuotationController::class, 'show'])->name('quotations.show'); // View quotation
        Route::put('/portal/distribution/quotations/{id}/cancel', [QuotationController::class, 'cancel'])->name('quotations.cancel'); // Cancel quotation

        Route::get('/quotations/{quotationId}/create-po', [PurchaseOrderController::class, 'create'])->name('quotations.create_po');
        Route::post('/quotations/{quotationId}/create-po', [PurchaseOrderController::class, 'store'])->name('quotations.store_po');
        Route::get('/distributor/purchase-orders', [PurchaseOrderController::class, 'index'])->name('distributor.purchase-orders.index');

        //routes profile
        Route::get('/distributor/profile', [ProfileDistributorController::class, 'show'])->name('distributor.profile.show');
        Route::get('/distributor/profile/edit', [ProfileDistributorController::class, 'edit'])->name('distributor.profile.edit');
        Route::put('/distributor/profile/update', [ProfileDistributorController::class, 'update'])->name('distributor.profile.update');
    });
});

Route::middleware(['auth', 'user-access:admin'])->group(function () {
    Route::group(['prefix' => LaravelLocalization::setLocale()], function () {
        Route::get('dashboard', [HomeController::class, 'dashboard'])->name('dashboard');

        Route::resource('admin/members', MemberController::class);
        Route::get('members/{id}/add-products', [MemberController::class, 'addProducts'])->name('members.add-products');
        Route::post('members/{id}/store-products', [MemberController::class, 'storeProducts'])->name('members.store-products');
        Route::get('members/{id}/edit-products', [MemberController::class, 'editProducts'])->name('members.edit-products');
        Route::put('members/{id}/update-products', [MemberController::class, 'updateProducts'])->name('members.update-products');
        Route::post('/members/{id}/update-password', [MemberController::class, 'updatePassword'])->name('members.updatePassword');
        Route::post('/admin/validate-password', [MemberController::class, 'validatePassword'])->name('admin.validatePassword');

        Route::get('/admin/distributors', [DistributorApprovalController::class, 'index'])->name('admin.distributors.index');
        Route::post('/admin/distributors/{id}/approve', [DistributorApprovalController::class, 'approve'])->name('admin.distributors.approve');
        Route::get('/admin/distributors/{id}', [DistributorApprovalController::class, 'show'])->name('admin.distributors.show');

        Route::get('/admin', [AdminController::class, 'index'])->name('admin.index'); // Daftar admin
        Route::get('/admin/create', [AdminController::class, 'create'])->name('admin.create'); // Form tambah admin
        Route::post('/admin', [AdminController::class, 'store'])->name('admin.store'); // Simpan admin baru
        Route::get('/admin/{admin}/edit', [AdminController::class, 'edit'])->name('admin.edit'); // Form edit admin
        Route::put('/admin/{admin}', [AdminController::class, 'update'])->name('admin.update'); // Update admin
        Route::delete('/admin/{admin}', [AdminController::class, 'destroy'])->name('admin.destroy'); // Hapus admin


        // Routes Tiketing Layanan untuk Admin
        Route::get('/admin/tickets', [TicketController::class, 'index'])->name('admin.tickets.index');
        Route::put('/admin/tickets/{id}/process', [TicketController::class, 'process'])->name('admin.tickets.process');
        Route::put('/admin/tickets/{id}/complete', [TicketController::class, 'complete'])->name('admin.tickets.complete');
        Route::get('/admin/tickets/{id}', [TicketController::class, 'show'])->name('admin.tickets.show');

        Route::get('/admin/quotations', [QuotationAdminController::class, 'index'])->name('admin.quotations.index');
        Route::put('/quotations/{id}/status', [QuotationAdminController::class, 'updateStatus'])->name('admin.quotations.updateStatus');
        Route::post('/quotations/{id}/upload-file', [QuotationAdminController::class, 'uploadFile'])->name('admin.quotations.uploadFile');

        Route::get('admin/quotations/{id}/show', [QuotationAdminController::class, 'show'])->name('admin.quotations.show');
        Route::get('admin/quotations/{id}/edit', [QuotationAdminController::class, 'edit'])->name('admin.quotations.edit');
        Route::put('admin/quotations/{id}', [QuotationAdminController::class, 'update'])->name('admin.quotations.update');

        // Menampilkan semua negosiasi untuk ditinjau admin
        Route::get('/admin/quotations/negotiations', [QuotationNegotiationController::class, 'index'])->name('admin.quotations.negotiations.index');
        // Menerima negosiasi
        Route::put('/admin/quotations/negotiations/{id}/accept', [QuotationNegotiationController::class, 'accept'])->name('admin.quotations.negotiations.accept');
        Route::put('/admin/quotations/negotiations/{id}/process', [QuotationNegotiationController::class, 'process'])->name('admin.quotations.negotiations.process');
        // Menolak negosiasi
        Route::put('/admin/quotations/negotiations/{id}/reject', [QuotationNegotiationController::class, 'reject'])->name('admin.quotations.negotiations.reject');
        Route::get('/purchase-orders', [PurchaseOrderAdminController::class, 'index'])->name('admin.purchase-orders.index');
        Route::get('/purchase-orders/{id}', [PurchaseOrderAdminController::class, 'show'])->name('admin.purchase-orders.show');
        Route::put('/purchase-orders/{id}/approve', [PurchaseOrderAdminController::class, 'approve'])->name('admin.purchase-orders.approve');
        Route::put('/purchase-orders/{id}/reject', [PurchaseOrderAdminController::class, 'reject'])->name('admin.purchase-orders.reject');
        Route::put('/purchase-orders/{id}/po-number', [PurchaseOrderAdminController::class, 'updatePoNumber'])->name('admin.purchase-orders.update-po-number');


        Route::get('admin/purchase-orders/{id}/create-proforma-invoice', [ProformaInvoiceAdminController::class, 'create'])->name('admin.proforma-invoices.create');
        Route::post('admin/purchase-orders/{id}/store-proforma-invoice', [ProformaInvoiceAdminController::class, 'store'])->name('admin.proforma-invoices.store');
        Route::get('/admin/proforma-invoices', [ProformaInvoiceAdminController::class, 'index'])->name('admin.proforma-invoices.index');
        Route::get('/admin/proforma-invoices/{id}', [ProformaInvoiceAdminController::class, 'show'])->name('admin.proforma-invoices.show');
        Route::put('/admin/proforma-invoices/{id}/approve-reject', [ProformaInvoiceAdminController::class, 'approveRejectPayment'])
            ->name('admin.proforma-invoices.approve-reject');


        // Route untuk index dan pembuatan invoice
        Route::get('/invoices', [InvoiceAdminController::class, 'index'])->name('invoices.index');
        Route::get('/invoices/create/{proformaInvoiceId}', [InvoiceAdminController::class, 'create'])->name('invoices.create');
        Route::post('/invoices/store/{proformaInvoiceId}', [InvoiceAdminController::class, 'store'])->name('invoices.store');
        Route::get('/invoices/{id}', [InvoiceAdminController::class, 'show'])->name('invoices.show');



        Route::get('/admin/visitors', [VisitorController::class, 'index'])->name('admin.visitors');
        Route::resource('admin/produk', ProdukController::class)->names('admin.produk');
        Route::resource('admin/parameter', CompanyParameterController::class);
        Route::resource('admin/bidangperusahaan', BidangPerusahaanController::class);
        Route::resource('admin/kategori', KategoriController::class)->names('admin.kategori');
        Route::resource('admin/faq', FAQController::class)->names('admin.faq');
        Route::resource('admin/slider', SliderController::class)->names('admin.slider');
        Route::resource('admin/activity', ActivityController::class)->names('admin.activity');
        Route::resource('admin/brand', BrandPartnerController::class)->names('admin.brand');
        Route::resource('admin/meta', MetaController::class)->names('admin.meta');
        Route::post('/froala/upload_image', [MetaController::class, 'uploadImage'])->name('froala.upload_image');
        Route::resource('admin/location', LocationController::class)->names('admin.location');
    });
});