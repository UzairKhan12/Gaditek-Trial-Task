<?php

use Illuminate\Support\Facades\Route;

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

const BLOGS_CONTROLLER = \App\Http\Controllers\BlogsController::class;


Route::get('/', [BLOGS_CONTROLLER, 'show']);

$module_routes = [
    'blogs' => [
        'controller' => BLOGS_CONTROLLER
    ]
];

foreach ($module_routes as $module_name => $module_route) {

    //Standard Routes
    Route::get($module_name, [$module_route['controller'], 'show'])->name($module_name . '_show');

    Route::get($module_name . '_dtListing', [$module_route['controller'], 'dtListing'])->name($module_name . '_dtListing');

    Route::get($module_name . '_add', [$module_route['controller'], 'add'])->name($module_name . '_add');

    Route::post($module_name . '_add', [$module_route['controller'], 'store'])->name($module_name . '_store');

    Route::get($module_name . '_edit/{id}', [$module_route['controller'], 'edit'])->name($module_name . '_edit');

    Route::post($module_name . '_edit', [$module_route['controller'], 'update'])->name($module_name . '_update');

    Route::get($module_name . '_delete/{id}', [$module_route['controller'], 'delete'])->name($module_name . '_delete');

    Route::get($module_name . '_view', [$module_route['controller'], 'view'])->name($module_name . '_view');


}

