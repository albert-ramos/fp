<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\External\Client\CreateClientController;
use App\Http\Controllers\External\Client\FindPharmacyController;
use App\Http\Controllers\External\Client\AddPointsToClientController;
use App\Http\Controllers\External\Client\ConsumeClientPointsController;


/**
 * Initalizes?
 */
Route::get('/ping', function() {
    return 'pong';
});

Route::group(
    [           
        'namespace' => 'External',
        'prefix' => '10',
    ], function(){

        /**
         * Client group
         */
        Route::group([
            'prefix' => 'client'
        ], function() {

            Route::post('/create', [CreateClientController::class, '__invoke'])->name('client:create');
            
            /**
             * Points
             */
            Route::group([
                'prefix' => 'points'
            ], function() {
                Route::post('/add', [AddPointsToClientController::class, '__invoke'])->name('client:points:add');
                Route::post('/consume', [ConsumeClientPointsController::class, '__invoke'])->name('client:points:consume');
            });
        });


        /**
         * Client group
         */
        Route::group([
            'prefix' => 'pharmacy'
        ], function() {

            Route::post('/find', [FindPharmacyController::class, '__invoke'])->name('pharmacy:find');
            
        });
});

