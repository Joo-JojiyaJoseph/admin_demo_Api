<?php

use App\Http\Controllers\Api\ViewController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::middleware(['cors'])->group(function () {
    Route::get('/slider',[ViewController::class,'sliders']);
    Route::get('/baseimageurl',[ViewController::class,'baseimageurl']);
    Route::get('/logo',[ViewController::class,'logo']);
    // Route::get('/seo',[ViewController::class,'seo']);
    Route::get('/seo/{page}', [ViewController::class, 'getSeoData']);

    Route::get('/gallery',[ViewController::class,'gallery']);
    Route::get('/testimonials',[ViewController::class,'apitestimonials']);
    Route::post('/contact',[ViewController::class,'contacts']);
     Route::get('/project',[ViewController::class,'projects']);
     Route::get('/projectids/{id}', [ViewController::class, 'projectids']);
     Route::get('/serviceids/{id}', [ViewController::class, 'serviceids']);
     Route::get('/service',[ViewController::class,'service']);
     Route::get('/clients',[ViewController::class,'clients']);
     Route::get('/brochure',[ViewController::class,'brochure']);
     Route::get('/job',[ViewController::class,'job']);

});


