<?php

namespace App\Providers;

use MoonShine\MoonShine;
use MoonShine\Menu\MenuItem;
use MoonShine\Menu\MenuGroup;
use Illuminate\Support\ServiceProvider;
use App\MoonShine\Resources\CategoryResource;
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
            ])->translatable(),

            MenuItem::make('Category', new CategoryResource())
                    ->translatable()
                    ->icon('add'),

            MenuItem::make('Documentation', 'https://laravel.com')
                ->badge(fn() => 'Check'),
        ]);
    }
}
