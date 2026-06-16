<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Service;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

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
    public function boot(): void
    {
        //
        $services = Service::latest()->take(6)->get();

        View::share('allServices', $services);

        View::composer('*', function ($view) {

            $userId = null;

            if (Auth::guard('vendor')->check()) {

                $userId = Auth::guard('vendor')->id();
            } elseif (Auth::check()) {

                $userId = Auth::id();
            }

            $messageCount = 0;

            if ($userId) {

                $messageCount = Message::where('receiver_id', $userId)
                    ->where('is_read', 0)
                    ->count();
            }

            $view->with('messageCount', $messageCount);
        });
    }
}
