<?php
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ScraperController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\WebsitesController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\LinksController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ArticlesController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

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

//Route::get('/', function () {
 //   return view('welcome');
//});




Route::get('/', [HomeController::class, 'index']);
Route::get('/article-details/{id}', [HomeController::class, 'contact'])->name('home.contact');
Route::get('/category/{id}', [HomeController::class, 'getCategory']);



Route::group(['prefix'=>'dashboard'], function() {
    Route::resource('/websites', WebsitesController::class);
    Route::resource('/categories', CategoriesController::class);
    Route::patch('/links/set-item-schema', [LinksController::class, 'setItem']);
    Route::post('/links/scrape', [LinksController::class, 'scrape']);

    Route::resource('/links', LinksController::class);
    Route::resource('/item', ItemController::class);
    Route::resource('/articles', ArticlesController::class);
});