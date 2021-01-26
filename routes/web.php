<?php

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

Route::get('login', 'Auth\LoginController@showLoginForm')->name('admin.login');
Route::post('login', 'Auth\LoginController@login');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');

Auth::routes([
    'register' => false,
]);

Route::any('/ckfinder/connector', '\CKSource\CKFinderBridge\Controller\CKFinderController@requestAction')
    ->name('ckfinder_connector');

Route::any('/ckfinder/browser', '\CKSource\CKFinderBridge\Controller\CKFinderController@browserAction')
    ->name('ckfinder_browser');

Route::group(['prefix' => 'admin', 'middleware' => 'auth', 'as' => 'admin.'], function () {
    //dashboard
    Route::get('/', 'Admin\DashboardController@index')->name('dashboard');

    //pages
    Route::get('/page/order', 'Admin\PageController@order')->name('page.order');
    Route::post('/page/order/set', 'Admin\PageController@setOrder')->name('page.order.set');
    Route::post('/page/get-by-type', 'Admin\PageController@getParentPageByType')->name('page.get.byType');
    Route::get('/page/{id}/translation/{lang}/add', 'Admin\PageController@addTranslation')->name('page.translation.add');
    Route::put('/page/{id}/translation/update', 'Admin\PageController@updateTranslation')->name('page.translation.update');

    Route::resource('page', 'Admin\PageController')->names([
        'index'  => 'page.index',
        'store'  => 'page.store',
        'update' => 'page.update',
        'delete' => 'page.destroy',
    ]);

});

Route::group([
    'as'         => 'front.',
    'prefix'     => LocalizationService::locale(),
    'middleware' => 'setLocale'
], function () {
    Route::get('/', 'Front\HomeController@index')->name('home');
    Route::get('/home', 'Front\HomeController@index')->name('home');
    Route::get('/{slug}', 'Front\PageController@index')->name('page.index');
});

