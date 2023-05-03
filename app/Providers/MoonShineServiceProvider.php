<?php

namespace App\Providers;

use App\MoonShine\Resources\CategoryResource;
use Illuminate\Support\ServiceProvider;
use MoonShine\Menu\MenuGroup;
use MoonShine\Menu\MenuItem;
use MoonShine\MoonShine;
use MoonShine\Resources\MoonShineUserResource;
use MoonShine\Resources\MoonShineUserRoleResource;

class MoonShineServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        app(MoonShine::class)->menu([
            MenuGroup::make('moonshine::ui.resource.system', [
                MenuItem::make('Admins', new MoonShineUserResource()),
                MenuItem::make('moonshine::ui.resource.admins_title', new MoonShineUserResource())
                    ->translatable()
                    ->icon('users'),
                MenuItem::make('moonshine::ui.resource.role_title', new MoonShineUserRoleResource())
                    ->translatable()
                    ->icon('bookmark'),
            ])->translatable()->icon('heroicons.server'),
            MenuGroup::make('Master Data', [
                MenuItem::make('Category', new CategoryResource())
                    ->translatable()
                    ->icon('add'),
            ])  ->translatable()
                ->icon('heroicons.table-cells'),
            MenuItem::make('Documentation', 'https://laravel.com')
                ->badge(fn() => 'Check'),
        ]);
    }
}
