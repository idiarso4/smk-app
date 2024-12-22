<?php

namespace App\Providers\Filament;

use Filament\Support\Assets\Css;
use Filament\Support\Assets\Js;
use Filament\Support\Facades\FilamentAsset;
use Illuminate\Support\ServiceProvider;

class CustomLoginProvider extends ServiceProvider
{
    public function boot(): void
    {
        FilamentAsset::register([
            Css::make('custom-login', __DIR__ . '/../../../resources/css/custom-login.css'),
            Js::make('custom-login', __DIR__ . '/../../../resources/js/custom-login.js'),
        ]);
    }
} 