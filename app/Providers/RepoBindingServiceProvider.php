<?php
namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepoBindingServiceProvider extends ServiceProvider {
    public function register() {
        $app = $this->app;

        $app->bind('\App\Repositories\Contracts\UsersInterface', function()
        {
            $repository =  new \App\Repositories\UsersRepository(new \App\User);
            return $repository;
        });

    }
}