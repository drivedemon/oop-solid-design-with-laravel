<?php

namespace App\Providers;

use App\Domain\Document\Adapters\GroupPolicyDocumentService;
use App\Domain\Document\Adapters\UserDocumentService;
use App\Domain\Document\Adapters\UserGroupDocumentService;
use App\Domain\Document\DocumentService;
use App\Domain\Document\GroupPolicyDocument\GroupPolicyDocumentRepository;
use App\Domain\Document\UserDocument\UserDocumentRepository;
use App\Domain\Document\UserGroupDocument\UserGroupDocumentRepository;
use App\Models\PersonalAccessToken;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;
use Laravel\Sanctum\Sanctum;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(DocumentService::class, function ($app) {
            return new DocumentService(
                $app->get(GroupPolicyDocumentService::class),
                $app->get(UserDocumentService::class),
                $app->get(UserGroupDocumentService::class),
            );
        });

        $this->app->bind(GroupPolicyDocumentService::class, function ($app) {
            return new GroupPolicyDocumentService($app->make(GroupPolicyDocumentRepository::class));
        });

        $this->app->bind(UserDocumentService::class, function ($app) {
            return new UserDocumentService($app->make(UserDocumentRepository::class));
        });

        $this->app->bind(UserGroupDocumentService::class, function ($app) {
            return new UserGroupDocumentService($app->make(UserGroupDocumentRepository::class));
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // disable lazy loading in non-production environments
        Model::preventLazyLoading(! $this->app->isProduction()); // Do not comment out this line, fix your query

        Sanctum::usePersonalAccessTokenModel(PersonalAccessToken::class);
    }
}
