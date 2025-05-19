@extends('layouts.Member.master')

@section('content')
<!-- Header Start -->
<div class="container-fluid page-header mb-5 py-5"
    style="background: linear-gradient(rgba(0, 0, 0, .4), rgba(0, 0, 0, .1)), url('{{ asset('assets/img/member.jpg') }}') center center no-repeat; background-size: cover; height: 300px;">
    <div class="container">
        <h1 class="display-3 text-white mb-3 animated slideInDown">{{ __('messages.distributor_portal') }}</h1>
        <nav aria-label="breadcrumb animated slideInDown">
            <ol class="breadcrumb text-uppercase">
                <li class="breadcrumb-item"><a class="text-white" href="{{ url('/') }}">{{ __('messages.home') }}</a>
                </li>
                <li class="breadcrumb-item text-white active" aria-current="page">{{ __('messages.distributor_portal') }}</li>
            </ol>
        </nav>
    </div>
</div>

<!-- Services Start -->
<div class="container-fluid service py-5">
    <div class="container py-5">
        <div class="row g-4 justify-content-center">
            <!-- Pilih Produk & Minta Quotation -->
            <div class="col-md-6 col-lg-4 col-xl-3 wow fadeInUp" data-wow-delay="0.5s">
                <div class="service-item rounded">
                    <div class="service-img rounded-top"
                        style="display: flex; justify-content: center; align-items: center; height: 200px; width: 250px; margin: 0 auto; background-color: #1E60AA;">
                        <i class='bx bx-package' style="font-size: 200px; color: #fff;"></i>
                    </div>
                    <div class="service-content rounded-bottom bg-light p-4">
                        <div class="service-content-inner">
                            <h5 class="mb-4">{{ __('messages.product_quotation') }}</h5>
                            <a href="{{ route('distribution.request-quotation') }}"
                                class="btn btn-primary rounded-pill text-white py-2 px-4 mb-2">{{ __('messages.view_quotation') }}</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Kelola Invoice -->
            <div class="col-md-6 col-lg-4 col-xl-3 wow fadeInUp" data-wow-delay="0.5s">
                <div class="service-item rounded">
                    <div class="service-img rounded-top"
                        style="display: flex; justify-content: center; align-items: center; height: 200px; width: 250px; margin: 0 auto; background-color: #1E60AA;">
                        <i class='bx bx-receipt' style="font-size: 200px; color: #fff;"></i>
                    </div>
                    <div class="service-content rounded-bottom bg-light p-4">
                        <div class="service-content-inner">
                            <h5 class="mb-4">{{ __('messages.invoice') }}</h5>
                            <a href="{{ route('distributor.invoices.index') }}"
                                class="btn btn-primary rounded-pill text-white py-2 px-4 mb-2">{{ __('messages.view_invoice') }}</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Lihat Negosiasi -->
            <div class="col-md-6 col-lg-4 col-xl-3 wow fadeInUp" data-wow-delay="0.5s">
                <div class="service-item rounded">
                    <div class="service-img rounded-top"
                        style="display: flex; justify-content: center; align-items: center; height: 200px; width: 250px; margin: 0 auto; background-color: #1E60AA;">
                        <i class='bx bx-conversation' style="font-size: 200px; color: #fff;"></i>
                    </div>
                    <div class="service-content rounded-bottom bg-light p-4">
                        <div class="service-content-inner">
                            <h5 class="mb-4">{{ __('messages.negotiations') }}</h5>
                            <a href="{{ route('distributor.quotations.negotiations.index') }}"
                                class="btn btn-primary rounded-pill text-white py-2 px-4 mb-2">{{ __('messages.view_details') }}</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Kelola Proforma Invoice -->
            <div class="col-md-6 col-lg-4 col-xl-3 wow fadeInUp" data-wow-delay="0.5s">
                <div class="service-item rounded">
                    <div class="service-img rounded-top"
                        style="display: flex; justify-content: center; align-items: center; height: 200px; width: 250px; margin: 0 auto; background-color: #1E60AA;">
                        <i class='bx bx-file' style="font-size: 200px; color: #fff;"></i>
                    </div>
                    <div class="service-content rounded-bottom bg-light p-4">
                        <div class="service-content-inner">
                            <h5 class="mb-4">{{ __('messages.proforma_invoice') }}</h5>
                            <a href="{{ route('distributor.proforma-invoices.index') }}"
                                class="btn btn-primary rounded-pill text-white py-2 px-4 mb-2">{{ __('messages.view_proforma_invoice') }}</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Lihat PO -->
            <div class="col-md-6 col-lg-4 col-xl-3 wow fadeInUp" data-wow-delay="0.5s">
                <div class="service-item rounded">
                    <div class="service-img rounded-top"
                        style="display: flex; justify-content: center; align-items: center; height: 200px; width: 250px; margin: 0 auto; background-color: #1E60AA;">
                        <i class='bx bx-cart' style="font-size: 200px; color: #fff;"></i>
                    </div>
                    <div class="service-content rounded-bottom bg-light p-4">
                        <div class="service-content-inner">
                            <h5 class="mb-4">{{ __('messages.view_po') }}</h5>
                            <a href="{{ route('distributor.purchase-orders.index') }}"
                                class="btn btn-primary rounded-pill text-white py-2 px-4 mb-2">{{ __('messages.view_po') }}</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Ticketing -->
            <div class="col-md-6 col-lg-4 col-xl-3 wow fadeInUp" data-wow-delay="0.5s">
                <div class="service-item rounded">
                    <div class="service-img rounded-top"
                        style="display: flex; justify-content: center; align-items: center; height: 200px; width: 250px; margin: 0 auto; background-color: #1E60AA;">
                        <i class='bx bx-receipt' style="font-size: 200px; color: #fff;"></i>
                    </div>
                    <div class="service-content rounded-bottom bg-light p-4">
                        <div class="service-content-inner">
                            <h5 class="mb-4">{{ __('messages.ticketing') }}</h5>
                            <a href="{{ route('distribution.tickets.index') }}"
                                class="btn btn-primary rounded-pill text-white py-2 px-4 mb-2">{{ __('messages.view_details') }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Services End -->
@endsection
