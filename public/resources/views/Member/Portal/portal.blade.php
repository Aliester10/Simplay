@extends('layouts.Member.master')

@section('content')
<!-- Header Start -->
<div class="container-fluid page-header mb-5 py-5"
    style="background: linear-gradient(rgba(0, 0, 0, .4), rgba(0, 0, 0, .1)), url('{{ asset('assets/img/member.jpg') }}') center center no-repeat; background-size: cover; height: 300px;">
    <div class="container">
        <h1 class="display-3 text-white mb-3 animated slideInDown">{{ __('messages.portal_member') }}</h1>
        <nav aria-label="breadcrumb animated slideInDown">
            <ol class="breadcrumb text-uppercase">
                <li class="breadcrumb-item"><a class="text-white" href="{{ url('/') }}">{{ __('messages.home') }}</a>
                </li>
                <li class="breadcrumb-item text-white active" aria-current="page">{{ __('messages.portal_member') }}
                </li>
            </ol>
        </nav>
    </div>
</div>
<!-- Header End -->

<!-- Services Start -->

<div class="container py-5">
    <div class="row g-4 justify-content-center">
        <div class="col-md-6 col-lg-4 col-xl-3 wow fadeInUp" data-wow-delay="0.1s">
            <div class="service-item rounded">
                <div class="service-img rounded-top"
                    style="display: flex; justify-content: center; align-items: center; height: 200px; width: 250px; margin: 0 auto; background-color: #1E60AA;">
                    <i class='bx bx-package' style="font-size: 200px; color: #fff;"></i>
                </div>
                <div class="service-content rounded-bottom bg-light p-4">
                    <div class="service-content-inner">
                        <h5 class="mb-4">{{ __('messages.my_product') }}</h5>
                        <a href="{{ route('portal.user-product') }}"
                            class="btn btn-primary rounded-pill text-white py-2 px-4 mb-2">{{ __('messages.see_more') }}</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-4 col-xl-3 wow fadeInUp" data-wow-delay="0.3s">
            <div class="service-item rounded">
                <div class="service-img rounded-top"
                    style="display: flex; justify-content: center; align-items: center; height: 200px; width: 250px; margin: 0 auto; background-color: #1E60AA;">
                    <i class='bx bx-book' style="font-size: 200px; color: #fff;"></i>
                </div>
                <div class="service-content rounded-bottom bg-light p-4">
                    <div class="service-content-inner">
                        <h5 class="mb-4">{{ __('messages.user_manual') }}</h5>
                        <a href="{{ route('portal.instructions') }}"
                            class="btn btn-primary rounded-pill text-white py-2 px-4 mb-2">{{ __('messages.see_more') }}</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-4 col-xl-3 wow fadeInUp" data-wow-delay="0.5s">
            <div class="service-item rounded">
                <div class="service-img rounded-top"
                    style="display: flex; justify-content: center; align-items: center; height: 200px; width: 250px; margin: 0 auto; background-color: #1E60AA;">
                    <i class='bx bx-file doc' style="font-size: 200px; color: #fff;"></i>
                </div>
                <div class="service-content rounded-bottom bg-light p-4">
                    <div class="service-content-inner">
                        <h5 class="mb-4">{{ __('messages.document') }}</h5>
                        <a href="{{ route('portal.document') }}"
                            class="btn btn-primary rounded-pill text-white py-2 px-4 mb-2">{{ __('messages.see_more') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div><br>
    <div class="row g-4 justify-content-center">
        <div class="col-md-6 col-lg-4 col-xl-3 wow fadeInUp" data-wow-delay="0.7s">
            <div class="service-item rounded">
                <div class="service-img rounded-top"
                    style="display: flex; justify-content: center; align-items: center; height: 200px; width: 250px; margin: 0 auto; background-color: #1E60AA;">
                    <i class='bx bx-video' style="font-size: 200px; color: #fff;"></i>
                </div>
                <div class="service-content rounded-bottom bg-light p-4">
                    <div class="service-content-inner">
                        <h5 class="mb-4">{{ __('messages.tutorials') }}</h5>
                        <a href="{{ route('portal.tutorials') }}"
                            class="btn btn-primary rounded-pill text-white py-2 px-4 mb-2">{{ __('messages.see_more') }}</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-4 col-xl-3 wow fadeInUp" data-wow-delay="0.5s">
            <div class="service-item rounded">
                <div class="service-img rounded-top"
                    style="display: flex; justify-content: center; align-items: center; height: 200px; width: 250px; margin: 0 auto; background-color: #1E60AA;">
                    <i class='bx bx-help-circle' style="font-size: 200px; color: #fff;"></i>
                </div>
                <div class="service-content rounded-bottom bg-light p-4">
                    <div class="service-content-inner">
                        <h5 class="mb-4">{{ __('messages.qna') }}</h5>
                        <a href="{{ route('portal.qna') }}"
                            class="btn btn-primary rounded-pill text-white py-2 px-4 mb-2">{{ __('messages.see_more') }}</a>
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
                        <h5 class="mb-4">Ticketing</h5>
                        <a href="{{ route('tickets.index') }}"
                            class="btn btn-primary rounded-pill text-white py-2 px-4 mb-2">{{ __('messages.see_more') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- Services End -->
@endsection