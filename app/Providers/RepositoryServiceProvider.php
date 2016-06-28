<?php

namespace Admin\Providers;

use Illuminate\Support\ServiceProvider;
use Admin\Repositories\Eloquent\CampaignEloquent;
use Admin\Repositories\Eloquent\CuisineEloquent;
use Admin\Repositories\Eloquent\AdminEloquent;
use Admin\Repositories\Eloquent\OutletEloquent;
use Admin\Repositories\Eloquent\RestaurantCuisineEloquent;
use Admin\Repositories\Eloquent\RestaurantEloquent;
use Admin\Repositories\Eloquent\SnapshotEloquent;
use Admin\Repositories\Interfaces\CampaignInterface;
use Admin\Repositories\Interfaces\CuisineInterface;
use Admin\Repositories\Interfaces\AdminInterface;
use Admin\Repositories\Interfaces\OutletInterface;
use Admin\Repositories\Interfaces\RestaurantCuisineInterface;
use Admin\Repositories\Interfaces\RestaurantInterface;
use Admin\Repositories\Interfaces\SnapShotInterface;
use Admin\Repositories\Eloquent\BlurbEloquent;
use Admin\Repositories\Interfaces\BlurbInterface;
use Admin\Repositories\Eloquent\PageEloquent;
use Admin\Repositories\Interfaces\PageInterface;
use Admin\Repositories\Eloquent\NotificationEloquent;
use Admin\Repositories\Interfaces\NotificationInterface;
use Admin\Repositories\Eloquent\FeaturedSectionEloquent;
use Admin\Repositories\Interfaces\FeaturedSectionInterface;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(AdminInterface::class, AdminEloquent::class);
        $this->app->bind(RestaurantInterface::class, RestaurantEloquent::class);
        $this->app->bind(OutletInterface::class, OutletEloquent::class);
        $this->app->bind(CuisineInterface::class, CuisineEloquent::class);
        $this->app->bind(RestaurantCuisineInterface::class, RestaurantCuisineEloquent::class);
        $this->app->bind(SnapShotInterface::class, SnapshotEloquent::class);
        $this->app->bind(CampaignInterface::class, CampaignEloquent::class);
        $this->app->bind(BlurbInterface::class, BlurbEloquent::class);
        $this->app->bind(PageInterface::class, PageEloquent::class);
        $this->app->bind(NotificationInterface::class, NotificationEloquent::class);
        $this->app->bind(FeaturedSectionInterface::class, FeaturedSectionEloquent::class);
    }
}
