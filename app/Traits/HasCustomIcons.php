<?php

namespace App\Traits;

// use Filament\Support\Facades\FilamentIcon;
// use Illuminate\Support\Facades\View;

trait HasCustomIcons
{
    // public static function registerIcons(): void
    // {
    //     FilamentIcon::register([
    //        //
    //     ]);
    // }

    public static function getCustomNavigationIcon(): ?string
    {
        return str(self::getNavigationIcon())
            ->replace('heroicon-o-', 'heroicon-s-')
            ->toString();
    }
}
