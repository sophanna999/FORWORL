<?php

    /*
    |--------------------------------------------------------------------------
    | Admin Routes
    |--------------------------------------------------------------------------
    |
    | Here is where you can register web routes for your application. These
    | routes are loaded by the RouteServiceProvider within a group which
    | contains the "web" middleware group. Now create something great!
    |
    */

    Route::get('/admin/login', 'Admin\AuthController@login');
    Route::post('/admin/CheckLogin', 'Admin\AuthController@CheckLogin');
    Route::get('/admin/debug', function(){
        return view('debug');
    });


    Route::group(['middleware' => 'admin_auth','prefix' => 'admin'], function(){
        Route::get('/', 'Admin\HomeController@index');
        Route::get('/logout', 'Admin\AuthController@logout');
        Route::get('/dashboard', 'Admin\HomeController@index');

        Route::post('/upload_file', 'Admin\UploadFileController@index');



        //User
        Route::get('/change_password', 'Admin\UserController@change_password');
        Route::get('/profile', 'Admin\UserController@profile');
        Route::get('/user/ListUser', 'Admin\UserController@ListUser');
        Route::post('/user/change_password', 'Admin\UserController@change_password');
        Route::post('/user/checkedit/{id}', 'Admin\UserController@update');
        Route::post('/user/delete/{id}', 'Admin\UserController@destroy');
        Route::resource('/user', 'Admin\UserController');
        // Route::get('/user', 'Admin\UserController@index');
        Route::get('/logout', 'Admin\AuthController@logout');

        //ManageMenu
        Route::get('/ManageMenu', 'Admin\MenuController@index');
        Route::get('/menu/ListMenu', 'Admin\MenuController@ListMenu');
        Route::post('/menu', 'Admin\MenuController@store');
        Route::get('/menu/{id}', 'Admin\MenuController@edit');
        Route::post('/menu/checkedit/{id}', 'Admin\MenuController@update');
        Route::post('/menu/delete/{id}', 'Admin\MenuController@destroy');

        //SetPermission
        Route::post('/SetPermission', 'Admin\MenuController@SetPermission');
        Route::post('/GetPermission/{id}', 'Admin\MenuController@GetPermission');

        Route::get('/Install', 'Admin\InstallController@index');
        Route::get('/Install/DefaultView', 'Admin\InstallController@DefaultView');
        Route::post('/Install/GetFieldDropDown', 'Admin\InstallController@GetFieldDropDown');
        Route::post('/Install/GetField/{table}', 'Admin\InstallController@GetField');
        Route::post('/Install', 'Admin\InstallController@Install');

        Route::get('/Menu', 'Admin\MenuController@index');
        Route::get('/Menu/Lists', 'Admin\MenuController@Lists');
        Route::post('/Menu', 'Admin\MenuController@store');
        Route::get('/Menu/{id}', 'Admin\MenuController@show');
        Route::post('/Menu/{id}', 'Admin\MenuController@update');
        Route::post('/Menu/Delete/{id}', 'Admin\MenuController@destroy');

        Route::post('/AdminUser/change_password', 'Admin\AdminUserController@change_password');
        Route::get('/AdminUser', 'Admin\AdminUserController@index');
        Route::get('/AdminUser/Lists', 'Admin\AdminUserController@Lists');
        Route::post('/AdminUser', 'Admin\AdminUserController@store');
        Route::get('/AdminUser/{id}', 'Admin\AdminUserController@show');
        Route::post('/AdminUser/{id}', 'Admin\AdminUserController@update');
        Route::post('/AdminUser/Delete/{id}', 'Admin\AdminUserController@destroy');

      Route::get('/Test', 'Admin\TestController@index');
        Route::get('/Test/Lists', 'Admin\TestController@Lists');
        Route::post('/Test', 'Admin\TestController@store');
        Route::get('/Test/{id}', 'Admin\TestController@show');
        Route::post('/Test/{id}', 'Admin\TestController@update');
        Route::post('/Test/Delete/{id}', 'Admin\TestController@destroy');

      Route::get('/User', 'Admin\UserController@index');
        Route::get('/User/Lists', 'Admin\UserController@Lists');
        Route::post('/User', 'Admin\UserController@store');
        Route::get('/User/{id}', 'Admin\UserController@show');
        Route::post('/User/{id}', 'Admin\UserController@update');
        Route::post('/User/Delete/{id}', 'Admin\UserController@destroy');

      Route::get('/Categories', 'Admin\CategoriesController@index');
        Route::get('/Categories/Lists', 'Admin\CategoriesController@Lists');
        Route::post('/Categories', 'Admin\CategoriesController@store');
        Route::get('/Categories/{id}', 'Admin\CategoriesController@show');
        Route::post('/Categories/{id}', 'Admin\CategoriesController@update');
        Route::post('/Categories/Delete/{id}', 'Admin\CategoriesController@destroy');

        Route::get('/Contact', 'Admin\ContactController@index');
        Route::post('/Contact', 'Admin\ContactController@operation');
        Route::post('/Contact/{id}', 'Admin\ContactController@operation');

        Route::post('/Inquire/Lists', 'Admin\InquireController@Lists');
        Route::post('/Inquire/{id}', 'Admin\InquireController@inquireOperation');

      Route::get('/Countries', 'Admin\CountriesController@index');
        Route::get('/Countries/Lists', 'Admin\CountriesController@Lists');
        Route::post('/Countries', 'Admin\CountriesController@store');
        Route::get('/Countries/{id}', 'Admin\CountriesController@show');
        Route::post('/Countries/{id}', 'Admin\CountriesController@update');
        Route::post('/Countries/Delete/{id}', 'Admin\CountriesController@destroy');

      Route::get('/Province', 'Admin\ProvinceController@index');
        Route::get('/Province/Lists', 'Admin\ProvinceController@Lists');
        Route::post('/Province', 'Admin\ProvinceController@store');
        Route::get('/Province/{id}', 'Admin\ProvinceController@show');
        Route::post('/Province/{id}', 'Admin\ProvinceController@update');
        Route::post('/Province/Delete/{id}', 'Admin\ProvinceController@destroy');

      Route::get('/Withdraw', 'Admin\WithdrawController@index');
        Route::get('/Withdraw/Lists', 'Admin\WithdrawController@Lists');
        Route::post('/Withdraw', 'Admin\WithdrawController@store');
        Route::get('/Withdraw/{id}', 'Admin\WithdrawController@show');
        Route::post('/Withdraw/{id}', 'Admin\WithdrawController@update');
        Route::post('/Withdraw/Delete/{id}', 'Admin\WithdrawController@destroy');

      Route::get('/Member', 'Admin\MemberController@index');
        Route::get('/Member/Lists', 'Admin\MemberController@Lists');
        Route::post('/Member', 'Admin\MemberController@store');
        Route::post('/Member/ChangePassword', 'Admin\MemberController@Changepassword');
        Route::get('/Member/{id}', 'Admin\MemberController@show');
        Route::post('/Member/{id}', 'Admin\MemberController@update');
        Route::post('/Member/Delete/{id}', 'Admin\MemberController@destroy');

      Route::get('/Article', 'Admin\ArticleController@index');
        Route::get('/Article/Lists', 'Admin\ArticleController@Lists');
        Route::post('/Article', 'Admin\ArticleController@store');
        Route::get('/Article/{id}', 'Admin\ArticleController@show');
        Route::post('/Article/{id}', 'Admin\ArticleController@update');
        Route::post('/Article/Delete/{id}', 'Admin\ArticleController@destroy');

      Route::get('/Banner', 'Admin\BannerController@index');
        Route::get('/Banner/Lists', 'Admin\BannerController@Lists');
        Route::post('/Banner', 'Admin\BannerController@store');
        Route::get('/Banner/{id}', 'Admin\BannerController@show');
        Route::post('/Banner/{id}', 'Admin\BannerController@update');
        Route::post('/Banner/Delete/{id}', 'Admin\BannerController@destroy');

      ##ROUTEFORINSTALL##

    Route::get('/GetProvince/{country}', 'FunctionController@GetProvince');
    });

    //OrakUploader
    Route::any('/upload_file', 'OrakController@upload_file');

?>
