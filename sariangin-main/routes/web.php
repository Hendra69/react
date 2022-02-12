<?php

use App\Http\Controllers\ContractController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DeliveryController;
use App\Http\Controllers\PriceController;
use App\Http\Controllers\TankCategoryController;
use App\Http\Controllers\TankController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\FakturController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

require __DIR__ . '/auth.php';

Route::group(
    [
        'prefix' => '',
        'as' => 'faktur.',
        'middleware' => ['auth']
    ],
    function () {
        Route::get('', [FakturController::class, 'index'])
            ->name('index');
    }
);

Route::group(
    [
        'prefix' => '',
        'as' => 'dashboard.',
        'middleware' => ['auth']
    ],
    function () {
        Route::get('', [DashboardController::class, 'index'])
            ->name('index');
    }
);

Route::group(
    [
        'prefix' => 'users',
        'as' => 'users.',
        'middleware' => ['auth']
    ],
    function () {
        Route::group(
            [
                'prefix' => 'ajax',
                'as' => 'ajax.'
            ],
            function () {
                Route::get('', [UserController::class, 'indexAjax'])
                    ->name('index');
            }
        );

        Route::get('', [UserController::class, 'index'])
            ->name('index');
        Route::post('', [UserController::class, 'store'])
            ->name('store');
        Route::get('create', [UserController::class, 'create'])
            ->name('create');
        Route::get('{user}/edit', [UserController::class, 'edit'])
            ->name('edit');
        Route::post('{user}', [UserController::class, 'update'])
            ->name('update');
        Route::delete('{user}', [UserController::class, 'destroy'])
            ->name('destroy');
    }
);

Route::group(
    [
        'prefix' => 'customers',
        'as' => 'customers.',
        'middleware' => ['auth']
    ],
    function () {
        Route::group(
            [
                'prefix' => 'ajax',
                'as' => 'ajax.'
            ],
            function () {
                Route::get('', [CustomerController::class, 'indexAjax'])
                    ->name('index');
            }
        );

        Route::get('', [CustomerController::class, 'index'])
            ->name('index');
        Route::post('', [CustomerController::class, 'store'])
            ->name('store');
        Route::get('create', [CustomerController::class, 'create'])
            ->name('create');
        Route::get('{customer}/edit', [CustomerController::class, 'edit'])
            ->name('edit');
        Route::post('{customer}', [CustomerController::class, 'update'])
            ->name('update');
        Route::delete('{customer}', [CustomerController::class, 'destroy'])
            ->name('destroy');
    }
);

Route::group(
    [
        'prefix' => 'vehicles',
        'as' => 'vehicles.',
        'middleware' => ['auth']
    ],
    function () {
        Route::group(
            [
                'prefix' => 'ajax',
                'as' => 'ajax.'
            ],
            function () {
                Route::get('', [VehicleController::class, 'indexAjax'])
                    ->name('index');
            }
        );

        Route::get('', [VehicleController::class, 'index'])
            ->name('index');
        Route::post('', [VehicleController::class, 'store'])
            ->name('store');
        Route::get('create', [VehicleController::class, 'create'])
            ->name('create');
        Route::get('{vehicle}/edit', [VehicleController::class, 'edit'])
            ->name('edit');
        Route::post('{vehicle}', [VehicleController::class, 'update'])
            ->name('update');
        Route::delete('{vehicle}', [VehicleController::class, 'destroy'])
            ->name('destroy');
    }
);

Route::group(
    [
        'prefix' => 'tank-categories',
        'as' => 'tank-categories.',
        'middleware' => ['auth']
    ],
    function () {
        Route::group(
            [
                'prefix' => 'ajax',
                'as' => 'ajax.'
            ],
            function () {
                Route::get('', [TankCategoryController::class, 'indexAjax'])
                    ->name('index');
                Route::get('{tankCategory}', [TankCategoryController::class, 'showAjax'])
                    ->name('show');
            }
        );

        Route::get('', [TankCategoryController::class, 'index'])
            ->name('index');
        Route::post('', [TankCategoryController::class, 'store'])
            ->name('store');
        Route::get('create', [TankCategoryController::class, 'create'])
            ->name('create');
        Route::get('{tankCategory}/edit', [TankCategoryController::class, 'edit'])
            ->name('edit');
        Route::post('{tankCategory}', [TankCategoryController::class, 'update'])
            ->name('update');
        Route::delete('{tankCategory}', [TankCategoryController::class, 'destroy'])
            ->name('destroy');
    }
);

Route::group(
    [
        'prefix' => 'tanks',
        'as' => 'tanks.',
        'middleware' => ['auth']
    ],
    function () {
        Route::group(
            [
                'prefix' => 'ajax',
                'as' => 'ajax.'
            ],
            function () {
                Route::get('', [TankController::class, 'indexAjax'])
                    ->name('index');
                Route::get('barcodes', [TankController::class, 'printBarcodes'])
                    ->name('print-barcodes');
            }
        );

        Route::get('', [TankController::class, 'index'])
            ->name('index');
        Route::post('', [TankController::class, 'store'])
            ->name('store');
        Route::get('create', [TankController::class, 'create'])
            ->name('create');
        Route::get('{tank}/edit', [TankController::class, 'edit'])
            ->name('edit');
        Route::get('{tank}/barcode', [TankController::class, 'showBarcode'])
            ->name('barcode');
        Route::post('{tank}', [TankController::class, 'update'])
            ->name('update');
        Route::delete('{tank}', [TankController::class, 'destroy'])
            ->name('destroy');
    }
);

Route::group(
    [
        'prefix' => 'prices',
        'as' => 'prices.',
        'middleware' => ['auth']
    ],
    function () {
        Route::group(
            [
                'prefix' => 'ajax',
                'as' => 'ajax.'
            ],
            function () {
                Route::get('', [PriceController::class, 'indexAjax'])
                    ->name('index');
                Route::post('', [PriceController::class, 'checkUnique'])
                    ->name('check-unique');
            }
        );

        Route::get('', [PriceController::class, 'index'])
            ->name('index');
        Route::post('', [PriceController::class, 'store'])
            ->name('store');
        Route::get('create', [PriceController::class, 'create'])
            ->name('create');
        Route::get('{price}/edit', [PriceController::class, 'edit'])
            ->name('edit');
        Route::post('{price}', [PriceController::class, 'update'])
            ->name('update');
        Route::delete('{price}', [PriceController::class, 'destroy'])
            ->name('destroy');
    }
);

Route::group(
    [
        'prefix' => 'delivery-notes',
        'as' => 'deliveries.',
        'middleware' => ['auth']
    ],
    function () {
        Route::group(
            [
                'prefix' => 'ajax',
                'as' => 'ajax.'
            ],
            function () {
                Route::get('', [DeliveryController::class, 'indexAjax'])
                    ->name('index');
            }
        );

        Route::get('', [DeliveryController::class, 'index'])
            ->name('index');
        Route::post('', [DeliveryController::class, 'store'])
            ->name('store');
        Route::get('create', [DeliveryController::class, 'create'])
            ->name('create');
        Route::get('{delivery}', [DeliveryController::class, 'show'])
            ->name('show');
        Route::get('{delivery}/edit', [DeliveryController::class, 'edit'])
            ->name('edit');
        Route::post('{delivery}', [DeliveryController::class, 'update'])
            ->name('update');
        Route::delete('{delivery}', [DeliveryController::class, 'destroy'])
            ->name('destroy');
    }
);

Route::group(
    [
        'prefix' => 'contracts',
        'as' => 'contracts.',
        'middleware' => ['auth']
    ],
    function () {
        Route::group(
            [
                'prefix' => 'ajax',
                'as' => 'ajax.'
            ],
            function () {
                Route::get('', [ContractController::class, 'indexAjax'])
                    ->name('index');
            }
        );

        Route::get('', [ContractController::class, 'index'])
            ->name('index');
        Route::post('', [ContractController::class, 'store'])
            ->name('store');
        Route::get('create', [ContractController::class, 'create'])
            ->name('create');
        Route::get('{contract}', [ContractController::class, 'show'])
            ->name('show');
        Route::get('{contract}/edit', [ContractController::class, 'edit'])
            ->name('edit');
        Route::post('{contract}', [ContractController::class, 'update'])
            ->name('update');
        Route::delete('{contract}', [ContractController::class, 'destroy'])
            ->name('destroy');
    }
);
