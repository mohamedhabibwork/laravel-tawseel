<?php

namespace Habib\LaravelTawseel;

use Habib\LaravelTawseel\Client\TawseelClient;
use Habib\LaravelTawseel\Contracts\TawseelClientInterface;
use Habib\LaravelTawseel\Enums\Environment;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Habib\LaravelTawseel\Commands\LaravelTawseelCommand;

class LaravelTawseelServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('laravel-tawseel')
            ->hasConfigFile()
            ->hasCommand(LaravelTawseelCommand::class);
    }

    public function packageRegistered(): void
    {
        $this->app->singleton(TawseelClientInterface::class, function ($app) {
            $config = $app['config']['tawseel'];

            return new TawseelClient(
                companyName: $config['company_name'] ?? '',
                password: $config['password'] ?? '',
                environment: Environment::from($config['environment'] ?? 'test'),
                timeout: $config['timeout'] ?? 30
            );
        });

        $this->app->alias(TawseelClientInterface::class, TawseelClient::class);
        $this->app->singleton(LaravelTawseel::class);
    }
}
