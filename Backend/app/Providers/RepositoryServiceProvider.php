<?php
namespace App\Providers;

use App\Repositories\Contracts\PropertyUpdatesRepositoryInterface;
use Illuminate\Support\ServiceProvider;
use App\Repositories\UserRepository;
use App\Repositories\WishlistRepository;
use App\Repositories\PropertyRepository;
use App\Repositories\NotificationRepository;
use App\Repositories\TourRepository;
use App\Repositories\ReportPropertyRepository;
use App\Repositories\ReportUserRepository;
use App\Repositories\AmenityRepository;
use App\Repositories\PropertyTypeRepository;
use App\Repositories\ImageRepository;
use App\Repositories\ReasonReportRepository;
use App\Repositories\ReviewRepository;
use App\Repositories\ReactionRepository;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Repositories\Contracts\WishlistRepositoryInterface;
use App\Repositories\Contracts\PropertyRepositoryInterface;
use App\Repositories\Contracts\NotificationRepositoryInterface;
use App\Repositories\Contracts\TourRepositoryInterface;
use App\Repositories\Contracts\ReportPropertyRepositoryInterface;
use App\Repositories\Contracts\ReportUserRepositoryInterface;
use App\Repositories\Contracts\AmenityRepositoryInterface;
use App\Repositories\Contracts\PropertyTypeRepositoryInterface;
use App\Repositories\Contracts\ImageRepositoryInterface;
use App\Repositories\Contracts\ReasonReportRepositoryInterface;
use App\Repositories\Contracts\ReviewRepositoryInterface;
use App\Repositories\Contracts\ReactionRepositoryInterface;
use App\Repositories\PropertyUpdatesRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(WishlistRepositoryInterface::class, WishlistRepository::class);
        $this->app->bind(PropertyRepositoryInterface::class, PropertyRepository::class);
        $this->app->bind(NotificationRepositoryInterface::class, NotificationRepository::class);
        $this->app->bind(TourRepositoryInterface::class, TourRepository::class);
        $this->app->bind(ReportPropertyRepositoryInterface::class, ReportPropertyRepository::class);
        $this->app->bind(ReportUserRepositoryInterface::class, ReportUserRepository::class);
        $this->app->bind(AmenityRepositoryInterface::class, AmenityRepository::class);
        $this->app->bind(PropertyTypeRepositoryInterface::class, PropertyTypeRepository::class);
        $this->app->bind(ImageRepositoryInterface::class, ImageRepository::class);
        $this->app->bind(ReasonReportRepositoryInterface::class, ReasonReportRepository::class);
        $this->app->bind(ReviewRepositoryInterface::class, ReviewRepository::class);
        $this->app->bind(ReactionRepositoryInterface::class, ReactionRepository::class);
        $this->app->bind(PropertyUpdatesRepositoryInterface::class, PropertyUpdatesRepository::class);

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        //
    }
}
