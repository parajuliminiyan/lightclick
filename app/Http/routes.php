<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::group(['middleware' => ['web']], function () {
//    Route::get('/index', 'IndexController@index');
    Route::post('/', 'IndexController@login');
    Route::get('/', 'IndexController@index')->name('login');
    Route::get('logout', 'HomeController@logout')->name('logout');
    Route::get('/signup', 'IndexController@signup')->name('signup');
    Route::post('/signup', 'IndexController@register')->name('register');

    Route::group(['middleware' => ['auth']], function () {
        Route::get('/home/{post}', 'PostController@getDeletePost')->name('postDelete');
        Route::get('/home', 'PostController@home')->name('home');
        Route::post('/createpost', 'PostController@postCreatePost')->name('post');
        Route::post('/docomment{post_id}', 'PostController@postcomments')->name('comments');

        Route::get('/account', 'HomeController@getAccount')->name('account');
        Route::post('/account{id}', 'HomeController@editAccount')->name('editaccount');
        Route::get('/search', 'SearchController@getResults')->name('search');
        Route::get('/user/{id}', 'profileController@getProfile')->name('profile');
        Route::get('/friends', 'FriendController@index')->name('friends');
        Route::get('/friends/add/{id}', 'FriendController@getAdd')->name('friend.Add');
        Route::get('/friends/accept/{first_name}', 'FriendController@getAccept')->name('friend.accept');
        Route::get('post/{postId}/like', 'PostController@getLike')->name('postlike');
        Route::post('editcomment/{id}', 'postController@editcomment')->name('editcomment');


        Route::post('/edit', 'PostController@editPost')->name('edit');

    });

});
