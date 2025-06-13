<?php

use Illuminate\Support\Facades\Facade;
use Illuminate\Support\ServiceProvider;

return [

    /*
    |--------------------------------------------------------------------------
    | Application Name
    |--------------------------------------------------------------------------
    |
    | This value is the name of your application. This value is used when the
    | framework needs to place the application's name in a notification or
    | any other location as required by the application or its packages.
    |
    */

    'name' => env('APP_NAME', 'Laravel'),

    /*
    |--------------------------------------------------------------------------
    | Application Environment
    |--------------------------------------------------------------------------
    |
    | This value determines the "environment" your application is currently
    | running in. This may determine how you prefer to configure various
    | services the application utilizes. Set this in your ".env" file.
    |
    */

    'env' => env('APP_ENV', 'production'),

    /*
    |--------------------------------------------------------------------------
    | Application Debug Mode
    |--------------------------------------------------------------------------
    |
    | When your application is in debug mode, detailed error messages with
    | stack traces will be shown on every error that occurs within your
    | application. If disabled, a simple generic error page is shown.
    |
    */

    'debug' => (bool) env('APP_DEBUG', false),

    /*
    |--------------------------------------------------------------------------
    | Application URL
    |--------------------------------------------------------------------------
    |
    | This URL is used by the console to properly generate URLs when using
    | the Artisan command line tool. You should set this to the root of
    | your application so that it is used when running Artisan tasks.
    |
    */

    'url' => env('APP_URL', 'http://localhost:8081/source-code/public'),

    'asset_url' => env('ASSET_URL'),

    /*
    |--------------------------------------------------------------------------
    | Application Timezone - UPDATED FOR REAL-TIME ACCURACY
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default timezone for your application, which
    | will be used by the PHP date and date-time functions. We have gone
    | ahead and set this to a sensible default for you out of the box.
    |
    | 🔥 UPDATED: Changed from UTC to Asia/Jakarta for Indonesia timezone
    | This ensures all timestamps match your local time when performing actions.
    |
    | Common Indonesia Timezones:
    | - 'Asia/Jakarta'   -> WIB (UTC+7) - Western Indonesia Time
    | - 'Asia/Makassar'  -> WITA (UTC+8) - Central Indonesia Time  
    | - 'Asia/Jayapura'  -> WIT (UTC+9) - Eastern Indonesia Time
    |
    | Other Common Timezones:
    | - 'Asia/Singapore' -> Singapore/Malaysia timezone
    | - 'UTC'           -> Universal Coordinated Time
    |
    */

    'timezone' => env('APP_TIMEZONE', 'Asia/Jakarta'), // 🔥 REAL-TIME TIMEZONE FOR INDONESIA

    /*
    |--------------------------------------------------------------------------
    | Application Locale Configuration
    |--------------------------------------------------------------------------
    |
    | The application locale determines the default locale that will be used
    | by the translation service provider. You are free to set this value
    | to any of the locales which will be supported by the application.
    |
    */

    'locale' => 'id',

    /*
    |--------------------------------------------------------------------------
    | Application Fallback Locale
    |--------------------------------------------------------------------------
    |
    | The fallback locale determines the locale to use when the current one
    | is not available. You may change the value to correspond to any of
    | the language folders that are provided through your application.
    |
    */

    'fallback_locale' => 'en',

    /*
    |--------------------------------------------------------------------------
    | Faker Locale
    |--------------------------------------------------------------------------
    |
    | This locale will be used by the Faker PHP library when generating fake
    | data for your database seeds. For example, this will be used to get
    | localized telephone numbers, street address information and more.
    |
    */

    'faker_locale' => 'id_ID', // 🔥 UPDATED: Changed to Indonesia locale

    /*
    |--------------------------------------------------------------------------
    | Encryption Key
    |--------------------------------------------------------------------------
    |
    | This key is used by the Illuminate encrypter service and should be set
    | to a random, 32 character string, otherwise these encrypted strings
    | will not be safe. Please do this before deploying an application!
    |
    */

    'key' => env('APP_KEY'),

    'cipher' => 'AES-256-CBC',

    /*
    |--------------------------------------------------------------------------
    | Maintenance Mode Driver
    |--------------------------------------------------------------------------
    |
    | These configuration options determine the driver used to determine and
    | manage Laravel's "maintenance mode" status. The "cache" driver will
    | allow maintenance mode to be controlled across multiple machines.
    |
    | Supported drivers: "file", "cache"
    |
    */

    'maintenance' => [
        'driver' => 'file',
        // 'store' => 'redis',
    ],

    /*
    |--------------------------------------------------------------------------
    | Date and Time Configuration - ENHANCED FOR REAL-TIME DISPLAY
    |--------------------------------------------------------------------------
    |
    | These configurations help with consistent date/time formatting across
    | the application for better user experience with real-time accuracy.
    |
    */

    'date_format' => env('APP_DATE_FORMAT', 'd/m/Y'), // 🔥 Indonesian date format
    'time_format' => env('APP_TIME_FORMAT', 'H:i:s'), // 🔥 24-hour time format
    'datetime_format' => env('APP_DATETIME_FORMAT', 'd/m/Y H:i:s'), // 🔥 Combined format

    /*
    |--------------------------------------------------------------------------
    | Payment System Configuration - ENHANCED FOR REAL-TIME TRACKING
    |--------------------------------------------------------------------------
    |
    | These configurations are specific to the payment proof system
    | to ensure accurate timestamp tracking and user experience.
    |
    */

    'payment' => [
        'timezone_display' => env('PAYMENT_TIMEZONE_DISPLAY', true), // Show timezone in UI
        'real_time_updates' => env('PAYMENT_REAL_TIME_UPDATES', true), // Enable real-time updates
        'timestamp_format' => env('PAYMENT_TIMESTAMP_FORMAT', 'd/m/Y H:i:s T'), // Include timezone
        'log_timezone_changes' => env('PAYMENT_LOG_TIMEZONE', true), // Log timezone operations
    ],

    /*
    |--------------------------------------------------------------------------
    | Autoloaded Service Providers
    |--------------------------------------------------------------------------
    |
    | The service providers listed here will be automatically loaded on the
    | request to your application. Feel free to add your own services to
    | this array to grant expanded functionality to your applications.
    |
    */

    'providers' => ServiceProvider::defaultProviders()->merge([
        /*
         * Package Service Providers...
         */

        /*
         * Application Service Providers...
         */
        App\Providers\AppServiceProvider::class,
        App\Providers\AuthServiceProvider::class,
        // App\Providers\BroadcastServiceProvider::class,
        App\Providers\EventServiceProvider::class,
        App\Providers\RouteServiceProvider::class,
        Mcamara\LaravelLocalization\LaravelLocalizationServiceProvider::class,
    ])->toArray(),

    /*
    |--------------------------------------------------------------------------
    | Class Aliases
    |--------------------------------------------------------------------------
    |
    | This array of class aliases will be registered when this application
    | is started. However, feel free to register as many as you wish as
    | the aliases are "lazy" loaded so they don't hinder performance.
    |
    */

    'aliases' => Facade::defaultAliases()->merge([
        // 'Example' => App\Facades\Example::class,
    ])->toArray(),

];