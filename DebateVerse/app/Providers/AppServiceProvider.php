<?php

namespace App\Providers;

use App\Repository\CategorieRepository;
use App\Repository\CategorieRepositoryInterface;
use App\Repository\DebateRepository;
use App\Repository\DebateRepositoryInterface;
use App\Repository\DebateTagRepository;
use App\Repository\DebateTagRepositoryInterface;
use App\Repository\MessageRepository;
use App\Repository\MessageRepositoryInterface;
use App\Repository\NotificationRepository;
use App\Repository\NotificationRepositoryInterface;
use App\Repository\TagRepository;
use App\Repository\TagRepositoryInterface;
use App\Repository\UserRepository;
use App\Repository\UserRepositoryInterface;
use App\serveces\FriendRequestService;
use App\serveces\FriendRequestServiceInterface;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Schema::defaultStringLength(191);

        $this->app->bind(NotificationRepositoryInterface::class, NotificationRepository::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(MessageRepositoryInterface::class, MessageRepository::class);
        $this->app->bind(DebateTagRepositoryInterface::class, DebateTagRepository::class);
        $this->app->bind(FriendRequestServiceInterface::class, FriendRequestService::class);
        $this->app->bind(TagRepositoryInterface::class, TagRepository::class);
        $this->app->bind(DebateRepositoryInterface::class, DebateRepository::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
