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
Route::get('/home', 'NoteController@index');
Route::get('', function(){
    return redirect('/home');
});
Route::get('/', function(){
    return redirect('/home');
});
Route::get('/MyProfile', 'UserController@myProfile');
Route::get('/chat', 'HomeController@chat');
Route::get('/registration', 'HomeController@registration');
Route::get('/welcome', 'HomeController@welcome');
Route::get('/addNotation', 'HomeController@addNotation');
Route::get('/user/{id}', 'UserController@getUser');


Route::post('/login', 'Auth\AuthController@login');
Route::get('/logout', 'Auth\AuthController@logout');
Route::post('/registration', 'Auth\AuthController@registration');

Route::post('/chat/update', 'MessageController@update');
Route::post('/chat/new', 'MessageController@newMessage');
Route::post('/chat/load', 'MessageController@loadMessages');

Route::post('/addNotation', 'NoteController@addNotation');
Route::post('/reUploadNotation', 'NoteController@reUploadNotation');
Route::get('/fixNote/{id}', 'NoteController@fixNote');
Route::get('/note/{id}', 'NoteController@getNotation');
Route::post('/deleteNote', 'NoteController@deleteNote');
Route::post('note/add_comment', 'CommentController@addComment');
Route::post('note/getComments', 'CommentController@getComments');
Route::post('note/downloadComments', 'CommentController@downloadComments');
Route::post('note/add_answer', 'CommentController@addAnswer');
Route::post('note/like', 'LikeVoteController@like');
Route::post('home/vote', 'LikeVoteController@vote');