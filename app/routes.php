<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/
/*Route::get('/home_orig', function()
{
    return View::make('pages.home');
});
Route::get('/novedades_orig', function()
{
    return View::make('pages.novedades');
});
Route::get('/nota_orig', function()
{
    return View::make('pages.nota');
});
Route::get('/video_orig', function()
{
    return View::make('pages.video');
});

Route::get('/galeria_imagenes_orig', function()
{
    return View::make('pages.galeria_imagenes');
});
Route::get('/imagen_orig', function()
{
    return View::make('pages.imagen');
});
Route::get('/galeria_videos_orig', function()
{
    return View::make('pages.galeria_videos');
});
*/

/**
 * Routes for guest
 */
//Route::group(['before' => 'guest'], function() {
    Route::get('/login', [
        'uses' => 'AdminController@index',
        'as' => 'backend.login'
    ]);

    Route::post('/login', [
        'uses' => 'AdminController@login',
        'as' => 'backend.login.post'
    ]);

    Route::get('/', function()
    {
        return View::make('index');
    });

    Route::get('/api/home', 'ApiController@home');

    Route::get('/api/lastNews', 'ApiController@lastNews');

    Route::get('/api/lastVideos', 'ApiController@lastVideos');

    Route::get('/api/lastAlbums', 'ApiController@lastAlbums');

    Route::get('/api/calendarEvents', 'ApiController@calendarEvents');

    Route::get('/api/news', 'ApiController@news');

    Route::get('/api/albums', 'ApiController@albums');

    Route::get('/api/videos', 'ApiController@videos');

    Route::post('/api/rate', 'ApiController@vote');

    App::missing(function($exception) { 
        return View::make('index'); 
    });
//});


/**
 * Blog Posts
 *
 */
Route::group(['before' => 'auth'], function() {

    Route::get('/logout', 'AdminController@logout');

    Route::get('/admin/', [
        'uses' => 'AdminController@dashIndex',
        'as' => 'backend.home'
    ]);

// - list
    Route::get('/admin/novedades/listado', [
        'uses' => 'NewsController@get',
        'as' => 'admin.news.list'
    ]);

    // - create
    Route::get('/admin/novedades/crear', [
        'uses' => 'NewsController@getCreate',
        'as' => 'admin.news.create'
    ]);

    Route::post('/admin/novedades/crear', 'NewsController@postCreate');

    // - update
    Route::get('/admin/novedades/actualizar/{id}', [
        'uses' => 'NewsController@getUpdate',
        'as' => 'admin.news.get'
    ])->where('id', '[0-9]+');

    Route::post('/admin/novedades/actualizar/{id}', 'NewsController@postUpdate')->where('id', '[0-9]+');

    Route::get('/admin/novedades/borrar/{id}', [
        'uses' => 'NewsController@delete',
        'as' => 'admin.news.delete'
    ])->where('id', '[0-9]+');

    Route::post('/admin/novedades/activarDesactivar', 'NewsController@activateDeactive');

    Route::post('/admin/novedades/actualizarPosicion', 'NewsController@updatePosition');

    ///CALENDARIO EVENTOS

    // - list
    Route::get('/admin/calendario-eventos/listado', [
        'uses' => 'EventsController@get',
        'as' => 'admin.events.list'
    ]);

    // - create
    Route::get('/admin/calendario-eventos/crear', [
        'uses' => 'EventsController@getCreate',
        'as' => 'admin.events.create'
    ]);

    Route::post('/admin/calendario-eventos/crear', 'EventsController@postCreate');

    // - update
    Route::get('/admin/calendario-eventos/actualizar/{id}', [
        'uses' => 'EventsController@getUpdate',
        'as' => 'admin.events.get'
    ])->where('id', '[0-9]+');

    Route::post('/admin/calendario-eventos/actualizar/{id}', 'EventsController@postUpdate')->where('id', '[0-9]+');

    Route::get('/admin/calendario-eventos/borrar/{id}', [
        'uses' => 'EventsController@delete',
        'as' => 'admin.events.delete'
    ])->where('id', '[0-9]+');

    Route::post('/admin/calendario-eventos/activarDesactivar', 'EventsController@activateDeactive');


    //galeria-imagenes
     Route::get('/admin/galeria-imagenes/listado', [
        'uses' => 'AlbumsController@get',
        'as' => 'admin.albums.list'
    ]);

    // - create
    Route::get('/admin/galeria-imagenes/crear', [
        'uses' => 'AlbumsController@getCreate',
        'as' => 'admin.albums.create'
    ]);

    Route::post('/admin/galeria-imagenes/crear', 'AlbumsController@postCreate');

    // - update
    Route::get('/admin/galeria-imagenes/actualizar/{id}', [
        'uses' => 'AlbumsController@getUpdate',
        'as' => 'admin.albums.get'
    ])->where('id', '[0-9]+');

    Route::post('/admin/galeria-imagenes/actualizar/{id}', 'AlbumsController@postUpdate')->where('id', '[0-9]+');

    Route::get('/admin/galeria-imagenes/borrar/{id}', [
        'uses' => 'AlbumsController@delete',
        'as' => 'admin.albums.delete'
    ])->where('id', '[0-9]+');

    //galeria-videos
     Route::get('/admin/galeria-videos/listado', [
        'uses' => 'VideosController@get',
        'as' => 'admin.videos.list'
    ]);

    // - create
    Route::get('/admin/galeria-videos/crear', [
        'uses' => 'VideosController@getCreate',
        'as' => 'admin.videos.create'
    ]);

    Route::post('/admin/galeria-videos/crear', 'VideosController@postCreate');

    // - update
    Route::get('/admin/galeria-videos/actualizar/{id}', [
        'uses' => 'VideosController@getUpdate',
        'as' => 'admin.videos.get'
    ])->where('id', '[0-9]+');

    Route::post('/admin/galeria-videos/actualizar/{id}', 'VideosController@postUpdate')->where('id', '[0-9]+');

    Route::get('/admin/galeria-videos/borrar/{id}', [
        'uses' => 'VideosController@delete',
        'as' => 'admin.videos.delete'
    ])->where('id', '[0-9]+');


    //HOME SLIDER

     Route::get('/admin/home-sliders/listado', [
        'uses' => 'HomeSlidersController@get',
        'as' => 'admin.home-sliders.list'
    ]);
    // - create
    Route::get('/admin/home-sliders/crear', [
        'uses' => 'HomeSlidersController@getCreate',
        'as' => 'admin.home-sliders.create'
    ]);

    Route::post('/admin/home-sliders/crear', 'HomeSlidersController@postCreate');

    // - update
    Route::get('/admin/home-sliders/actualizar/{id}', [
        'uses' => 'HomeSlidersController@getUpdate',
        'as' => 'admin.home-sliders.get'
    ])->where('id', '[0-9]+');

    Route::post('/admin/home-sliders/actualizar/{id}', 'HomeSlidersController@postUpdate')->where('id', '[0-9]+');

    Route::get('/admin/home-sliders/borrar/{id}', [
        'uses' => 'HomeSlidersController@delete',
        'as' => 'admin.home-sliders.delete'
    ])->where('id', '[0-9]+');
});