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
// use App\video;
Route::get('/', function () {

    // $videos = video::all();
    // foreach ($videos as $video) {
    //   echo $video->title;
    //   echo $video->user->email.'<br>';
    //   foreach ($video->comments as $comment) {
    //      echo $comment->body;
    //   }
    //   echo '<hr>';
    // }

    return view('welcome');
});

Route::auth();

Route::get('/home', array(
  'as' => 'home',
  'uses' => 'HomeController@index'
));

//ruta del controlador de videos
Route::get('/crear-video', array(
  'as' => 'createVideo',
  'middleware' => 'auth',
  'uses' => 'videoController@createVideo'
));

//ruta del para guardar el videos
Route::post('/guardar-video', array(
  'as' => 'saveVideo',
  'middleware' => 'auth',
  'uses' => 'videoController@saveVideo'
));

Route::get('/miniatura/{filename}',array(
  'as'=> 'imageVideo',
  'uses' => 'videoController@getImage'
));

Route::get('/video/{video_id}', array(
  'as' => 'detailVideo',
  'uses' => 'videoController@getVideoDetail'
));

Route::get('/video-file/{filename}',array(
  'as'=> 'videoFile',
  'uses' => 'videoController@getVideo'
));

Route::post('/comment',array(
  'as' => 'comment',
  'middleware' => 'auth',
  'uses' => 'CommentController@store'
));
