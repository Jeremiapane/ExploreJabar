<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Component Dinas
        Blade::component('dinas.layout', \App\View\Components\Dinas\Layout::class);
        Blade::component('dinas.menu-item', \App\View\Components\Dinas\MenuItem::class);
        Blade::component('dinas.submenu-item', \App\View\Components\Dinas\SubmenuItem::class);
        Blade::component('dinas.toast', \App\View\Components\Dinas\Toast::class);
        Blade::component('dinas.toast-container', \App\View\Components\Dinas\ToastContainer::class);
        Blade::component('dinas.kategori-modal', \App\View\Components\Dinas\KategoriModal::class);
        Blade::component('dinas.delete-kategori-modal', \App\View\Components\Dinas\DeleteKategoriModal::class);
        Blade::component('dinas.search-bar', \App\View\Components\Dinas\SearchBar::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Force HTTPS only in production environment
        if (app()->environment('production')) {
            \URL::forceScheme('https');
        }
    }
}
