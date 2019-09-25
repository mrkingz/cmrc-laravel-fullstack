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

Route::get('/', 'PageController@getIndex');

Auth::routes();

/*
 |--------------------------------------------------------
 | Password routes
 |--------------------------------------------------------
 */
Route::prefix('/password')->group(function(){
    Route::get('change', [
        'as' => 'password.form',
        'uses' => 'ChangePasswordController@changePasswordForm'
    ]);

    Route::get('/change/{token?}', [
        'as' => 'password.change',
        'uses' => 'ChangePasswordController@showResetForm'
    ]);

    Route::post('verify', [
        'as' => 'password.verify',
        'uses' => 'ChangePasswordController@verifyPassword'
    ]);
});


/*
 |--------------------------------------------------------
 | Pages routes
 |--------------------------------------------------------
 */
Route::get('/home', 'PageController@getHome');

Route::get('/about', [
    'as' => 'about',
    'uses' => 'PageController@getAbout'
]);

Route::get('/services', [
    'as' => 'services',
    'uses' => 'PageController@getServices'
]);

Route::paginate('/testimonials', [
    'as' => 'testimonials',
    'uses' => 'TestimonyController@index'
]);

Route::paginate('/testimony', [
    'as' => 'testimony.new',
    'uses' => 'TestimonyController@create'
]);

Route::post('/testimony/store', [
    'as' => 'testimony.store',
    'uses' => 'TestimonyController@store'
]);

Route::get('/blog', [
    'as' => 'blog',
    'uses' => 'PageController@getblog'
]);

Route::get('/polls', [
    'as' => 'polls',
    'uses' => 'PageController@getPolls'
]);


Route::get('/registration/activation/{id}/{token}', [
    'as' => 'activation',
    'uses' => 'Auth\RegisterController@activateAccount'
]);

/*
 |--------------------------------------------------------
 | Order routes
 |--------------------------------------------------------
 */
Route::prefix('order')->group(function() {
    Route::get('new/{type?}/{token?}', [
        'as' => 'new',
        'uses' => 'OrderController@create'
    ])->where(['type' => 'empirical|practical|educational']);

    Route::post('verification', [
        'as' => 'order.verify',
        'uses' => 'OrderController@showVerificationForm'
    ]);

    Route::post('store/{type}', [
        'as' => 'order.store',
        'uses' => 'OrderController@store'
    ]);

    Route::put('verify/{user}', [
        'as' => 'order.resend',
        'uses' => 'OrderController@updateCode'
    ]);
});


/*
 |--------------------------------------------------------
 | Publication routes
 |--------------------------------------------------------
 */
Route::prefix('resources')->group(function() {
    Route::paginate('view', [
        'as' => 'resources',
        'uses' => 'ResourcesController@index'
    ]);

    Route::get('{id}', [
        'as' => 'resource',
        'uses' => 'ResourcesController@show'
    ])->where(['id' => '[1-9]+']);

    Route::get('new/{type?}', [
        'as' => 'resources.type',
        'uses' => 'ResourcesController@create'
    ]);

    Route::post('new', [
        'as' => 'resources.create',
        'uses' => 'ResourcesController@showUploadForm'
    ])->where(['type' => 'article|audio|video']);


    Route::post('store', [
        'as' => 'resource.store',
        'uses' => 'ResourcesController@store'
    ]);

    
    Route::post('image/upload',  [
            'as' => 'upload',
            'uses' => 'ResourcesController@upload'
        ]);
    

    Route::get('find/{query}', [
        'as' => 'publication.find',
        'uses' => 'ResourcesController@searchPublication'
    ]);

    Route::delete('/{id}', [
        'as' => 'resource.delete',
        'uses' => 'ResourcesController@destroy'
    ]);
});

