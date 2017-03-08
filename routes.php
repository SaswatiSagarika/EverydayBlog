<?php
/**
    *File name: routes.
    *File type: php.
    *Purpose: it has links that connects to different pages and functions. 
    *Path:D:\PHP Projects\blog and comments\blog1\app\Http.
    **/
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

Route::get('/', 'WelcomeController@index');

Route::get('login', 'HomeController@index');

Route::get('/about', 'WelcomeController@about');

Route::get('/contact', 'WelcomeController@contact');

Route::get('/addnewpost', 'WelcomeController@addnewpost');

Route::get('/deleteconformationpage', 'PostController@deleteform');

Route::get('/list', 'PostController@showAllBlogRecords');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
Route::post('/createrecord',
    ['as'=>'/createrecord',
    'uses'=>'PostController@createnew'
    ]);
Route::post('/editblog/record',
    ['as'=>'/editblog/record',
    'uses'=>'PostController@createnew'
    ]);
Route::get('/addnewpost', 'WelcomeController@addnewpost');

Route::get('/editpage/blog', 'PostController@editform');

Route::get('/readpage/blog', 'PostController@readpost');

Route::post('/delete/blog',
    'PostController@destroyblog'
    );
Route::post('/editblog/record',
    'PostController@editblog'
    );
Route::post('/createcomment/Commentrecord',
    'CommentController@createcomments'
    );