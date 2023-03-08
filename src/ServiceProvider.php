<?php

declare(strict_types=1);

namespace GeekrOpenAI\Laravel;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use GeekrOpenAI\Laravel\Client\OpenAI;
use OpenAI\Client;
use GeekrOpenAI\Laravel\Exceptions\ApiKeyIsMissing;

/**
 * @internal
 */
class ServiceProvider extends BaseServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(Client::class, static function (): Client {
            $apiKey = config('openai.api_key');
            $baseUri = config('openai.base_uri');
            $organization = config('openai.organization');

            if (!is_string($apiKey) || ($organization !== null && !is_string($organization))) {
                throw ApiKeyIsMissing::create();
            }

            return OpenAI::client($apiKey, $baseUri, $organization);
        });

        $this->app->alias(Client::class, 'openai');
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->publishes([
            __DIR__ . '/../config/openai.php' => config_path('openai.php'),
        ]);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array<int, string>
     */
    public function provides(): array
    {
        return [
            Client::class,
        ];
    }
}
