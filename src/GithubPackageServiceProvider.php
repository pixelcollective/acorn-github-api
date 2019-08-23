<?php

namespace TinyPixel\Acorn\Github;

use TinyPixel\Acorn\Github\Github;
use Roots\Acorn\ServiceProvider;

/**
 * Business logics
 */
class GithubPackageServiceProvider extends ServiceProvider
{
    /**
     * Register application services
     */
    public function register()
    {
        $this->app->singleton('github.wp', function ($app) {
            return new Github($app->make('github'));
        });
    }

    /**
     * Boot application services.
     */
    public function boot()
    {
        $github = $this->app->make('github.wp');

        $github->setAccount('kellymears');

        dd($github->openIssues('kellymears', 'block-sandbox'));
    }
}
