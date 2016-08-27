<?php

// ___** Главная **___
Route::get('/', [
    'as'    =>  'index',
    'uses'  =>  'HomeController@index'
] );
// **********



// ___** Сохранение добавленного сообщения **___
Route::post('/', [
    'as'    =>  'index',
    'uses'  =>  'MsgController@save'
] );
// **********
     
// ___** "Мои записи" **___
Route::group(['prefix'=>'YourPosts','middleware'=>'auth'], function()
{
     Route::get('/', [
         'as'    =>  'YourMsgs',
         'uses'  =>  'YourMsgsController@show']);              
});
// **********

// ___** "Удалить запись" **___
Route::get('/delete/{slug}', [
         'as'    =>  'message',
         'uses'  =>  'MsgController@destroy'
     ] );
// **********

// ___** "Изменить запись" **___
Route::get('/change/{slug}', 'MsgController@change');
Route::post('/change/{slug}', 'MsgController@changed');
// **********




// ___** Авторизация **___
Route::get('/login', 'Auth\AuthController@getLogin');
Route::post('/login', 'Auth\AuthController@My_auth');
Route::get('/logout', 'Auth\AuthController@getLogout');
// **********

// ___** Регистрация **___
Route::get('/register', 'Auth\AuthController@getRegister');
Route::post('/register','AdvReg@register');
Route::get('/register/confirm/{token}','AdvReg@confirm');
// **********

// ___** Восттановление пароля **___
Route::get('/password/email', 'Auth\PasswordController@getEmail');
Route::post('/password/email', 'Auth\PasswordController@postEmail');
Route::get('/password/reset/{token}', 'Auth\PasswordController@getReset');
Route::post('/password/reset', 'Auth\PasswordController@postReset');
// **********



// ___** "Админка" **___
Route::group(['prefix'=>'SecretZone','middleware'=>'auth'], function()
{
     Route::get('/', [
         'as'    =>  'SecretZone',
         'uses'  =>  'MsgController@SecretZone']);              
});
// **********


Route::get(
    '/socialite/{provider}',
    [ 
        'as' => 'socialite.auth',
        function ( $provider ) {
            return \Socialite::driver( $provider )->redirect();
        }
    ]
);

Route::get('/socialite/{provider}/callback', [
    'as'    => 'social_login',
    'uses'  => 'auth\AuthController@social'
] );    


Route::post('/search', [
    'as'    => 'PostSearch',
    'uses'  => 'SrchController@Post_Srch'
] );

Route::get('/search/{find_it}', [
    'as'    => 'GetSearch',
    'uses'  => 'SrchController@Get_Srch'
]);


// ___** Отображение сообщений **___
Route::get('/{slug}', [
    'as'    =>  'message',
    'uses'  =>  'MsgController@show'
] );
// **********