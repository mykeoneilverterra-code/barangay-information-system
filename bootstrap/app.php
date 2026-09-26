<?php

use App\Http\Middleware\RoleMiddleware;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;

return Application::configure(
    basePath: dirname(__DIR__)
)

    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )

    ->withMiddleware(
        function (Middleware $middleware): void {

            /*
            |--------------------------------------------------------------------------
            | Custom Middleware Aliases
            |--------------------------------------------------------------------------
            */

            $middleware->alias([
                'role' => RoleMiddleware::class,
            ]);


            /*
            |--------------------------------------------------------------------------
            | Guest Redirect
            |--------------------------------------------------------------------------
            |
            | Resident URLs go to Resident Login.
            | Admin URLs go to Admin Login.
            |
            */

            $middleware->redirectGuestsTo(
                function (Request $request) {

                    if (
                        $request->is('portal')
                        || $request->is('portal/*')
                        || $request->is('resident/*')
                    ) {

                        return route(
                            'resident.login'
                        );
                    }


                    return route(
                        'admin.login'
                    );
                }
            );

        }
    )

    ->withExceptions(
        function (Exceptions $exceptions): void {
            //
        }
    )

    ->create();