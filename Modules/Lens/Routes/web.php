<?php

use Modules\Lens\Http\Controllers\LensController;
use Modules\Accounting\Http\Controllers\LenController;

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

Route::middleware('web', 'SetSessionData', 'auth', 'language', 'timezone', 'AdminSidebarMenu')->prefix('lens')->group(function () {
    Route::get('/', 'LensController@index');


        // Lens Companies
        Route::delete('lens-companies/destroy', 'LensCompanyController@massDestroy')->name('lens-companies.massDestroy');
        Route::resource('lens-companies', 'LensCompanyController');

        
                // Lens Diameters
                Route::delete('lens-diameters/destroy', 'LensDiameterController@massDestroy')->name('lens-diameters.massDestroy');
                Route::resource('lens-diameters', 'LensDiameterController');
        
                // Lens
                Route::delete('lens/destroy', 'LensController@massDestroy')->name('lens.massDestroy');
                Route::resource('lens', 'LensController');
                Route::get('show2/{id}','LensController@show2')->name('lens.show2');
                Route::get('show3/{id}','LensController@show3')->name('lens.show3');
                Route::get('show4/{id}','LensController@show4')->name('lens.show4');
                Route::get('show5/{id}','LensController@show5')->name('lens.show5');
                Route::post('store_quant/{id}','LensController@store_quant')->name('lens.store_quant');
                Route::post('store_quant1/{id}','LensController@store_quant1')->name('lens.store_quant1');
                Route::post('store_sell_price/{id}','LensController@store_sell_price')->name('lens.store_sell_price');
                Route::post('store_purch_price/{id}','LensController@store_purch_price')->name('lens.store_purch_price');
        
                Route::get('get_lens/{id}/{sph}/{cyl}',  [LensController::class,'get_lens'])->name('lens.get_lens');
                Route::get('get_lens_price/{id}/{sph}/{cyl}',  [LensController::class,'get_lens_price'])->name('lens.get_lens_price');
                Route::get('get_lens_purch_price/{id}/{sph}/{cyl}',  [LensController::class,'get_lens_purch_price'])->name('lens.get_lens_purch_price');

                
});
