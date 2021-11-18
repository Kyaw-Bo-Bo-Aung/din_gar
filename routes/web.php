<?php

use Illuminate\Support\Facades\Route;

//documentation
Route::get('/documentation', 'Frontend\PageController@documentation')->name('documentation');
// User Auth
Auth::routes();
Route::middleware('auth')->namespace('Frontend')->group(function(){
	Route::get('/', 'PageController@index')->name('home');
	Route::get('/profile', 'PageController@profile')->name('profile');
	Route::get('/change-password', 'PageController@changePassword')->name('change-password');
	Route::put('/update-password', 'PageController@changePasswordUpdate')->name('change-password.update');
	Route::get('/wallet', 'PageController@wallet')->name('wallet');
	Route::get('/real-time-wallet', 'PageController@realTimeWallet');

	Route::get('/transfer', 'PageController@transfer')->name('transfer');
	Route::get('/transfer/confirm', 'PageController@transferConfirm')->name('transfer-confirm');
	Route::post('/transfer/complete', 'PageController@transferComplete')->name('transfer.complete');
	// transfer ajax
	Route::post('/transfer/password-check/{password?}', 'PageController@passwordCheck');
	Route::post('/transfer/check-user/{phone}', 'PageController@transferCheckUser');

	Route::get('/transactions', 'PageController@transaction')->name('transactions.index');
	Route::get('/transactions/{id}', 'PageController@transactionShow')->name('transactions.show');
	// transaction ajax
	Route::get('/transaction/hash', 'PageController@hashValue');

	Route::get('/qr-code', 'PageController@qrCode');
	// scan and pay
	Route::get('/scan-and-pay', 'PageController@scanAndPay');
	Route::get('/scan-and-pay/form', 'PageController@scanAndPayForm');
	Route::get('/scan-and-pay/confirm', 'PageController@scanAndPayConfirm');
	Route::post('/scan-and-pay/complete', 'PageController@scanAndPayComplete');
	// notification
	Route::get('notifications', 'NotificationController@index');
	Route::get('notifications/{id}', 'NotificationController@show')->name('notifications.show');
});

// Admin User Auth
Route::get('/admin/login', 'Auth\AdminLoginController@showLoginForm');
Route::post('/admin/login', 'Auth\AdminLoginController@login')->name('admin.login');
Route::post('/admin/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');



