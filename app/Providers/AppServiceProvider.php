<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Cache;
use App\Models\Quotation;
use App\Models\CompanyParameter;
use App\Models\Meta;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        view()->composer('layouts.Admin.sidebar', function ($view) {
            $pendingCount = Quotation::where('status', 'pending')->count();
            $view->with('pendingCount', $pendingCount);
        });

        view()->composer([
            'layouts.Member.navbar',
            'layouts.Member.navbar-black',
            'layouts.Member.footer',
            'partials.whatsapp-button',
            'Member.Contact.contact_menu',
        ], function ($view) {
            $compro = Cache::remember('company_parameter:first', 300, function () {
                return CompanyParameter::first();
            });

            $activeMetas = Cache::remember('meta:active:' . now()->toDateString(), 300, function () {
                return Meta::where('start_date', '<=', today())
                    ->where('end_date', '>=', today())
                    ->get()
                    ->groupBy('type');
            });

            $view->with('compro', $compro)->with('activeMetas', $activeMetas);
        });
    }
}
