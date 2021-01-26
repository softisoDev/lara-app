<?php

namespace App\Providers;

use App\Mixins\CollectionMixin;
use Illuminate\Support\Collection;
use Illuminate\Support\ServiceProvider;
use ReflectionException;

class MacroServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     * @throws ReflectionException
     */
    public function boot()
    {
        Collection::mixin(new CollectionMixin);
        \Kalnoy\Nestedset\Collection::mixin(new CollectionMixin);
    }
}
