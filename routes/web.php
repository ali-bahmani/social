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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::middleware(['auth'])->group(function () {

    Route::Resource('/feed', 'App\Http\Controllers\FeedController');

    Route::get('/like/{feed}', 'App\Http\Controllers\FeedController@like')->name('like');

    Route::group(['prefix'=>'like', 'as' => 'like.'],function(){

        Route::get('/like/{feed}', 'App\Http\Controllers\FeedController@like')->name('index');

        Route::get('/count/{feed}', 'App\Http\Controllers\FeedController@likeCount')->name('likeCount');
    
    });

    Route::group(['prefix'=>'profile', 'as' => 'profile.'],function(){

        Route::get('/', 'App\Http\Controllers\ProfileController@index')->name('index');

        Route::get('/{user}', 'App\Http\Controllers\ProfileController@userProfile')->name('userProfile');
    
    });

    Route::group(['prefix'=>'explorer', 'as' => 'explorer.'],function(){

        Route::get('/', 'App\Http\Controllers\ExplorerController@index')->name('index');
    
    });

    Route::group(['prefix'=>'comment', 'as' => 'comment.'],function(){

        Route::post('/store/{feed_id}', 'App\Http\Controllers\CommentController@store')->name('store');
    
    });

    Route::group(['prefix'=>'follower', 'as' => 'follower.'],function(){

        Route::get('/follow', 'App\Http\Controllers\FollowerController@follow')->name('follow');
    
        Route::get('/unFollow', 'App\Http\Controllers\FollowerController@unFollow')->name('unFollow');

        Route::get('/followers/{user}', 'App\Http\Controllers\FollowerController@followers')->name('showAllFollowers');

    });

    Route::group(['prefix'=>'following', 'as' => 'following.'],function(){

        Route::get('/folowings/{user}', 'App\Http\Controllers\FollowingController@folowings')->name('showAllFollowings');

    });

    Route::get('/home', 'App\Http\Controllers\FeedController@index')->name('home');

    Route::group(['prefix'=>'activity', 'as' => 'activity.'],function(){

        Route::get('/notifications', 'App\Http\Controllers\ActivityController@notifications')->name('notifications');
    
    });

});

