<?php

use Illuminate\Http\Request;
// use DB;
use App\items;
use App\images;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('category','AndroidController@category');
Route::get('viewitems/{uid}/{cid}','AndroidController@itemdetails');
Route::get('gram_details/{uid}/{item_id}','AndroidController@GramDetails');
Route::get('kg_details/{uid}/{item_id}','AndroidController@KiloGramDetails');
Route::post('insertuser','AndroidController@adduser');
Route::get('slideimage','AndroidController@getimage');
Route::post('addcrt','AndroidController@addcrt');
Route::post('delcrt','AndroidController@delcart');
Route::post('viewcart','AndroidController@viewcarts');
Route::post('checkout','AndroidController@checkouts');
Route::post('login','AndroidController@login_user');
Route::get('recentorders/{uid}','AndroidController@recentorders');
Route::get('recentordersitems/{uid}/{oid}','AndroidController@recentordersitems');
Route::get('userprofile/{uid}','AndroidController@userprofile');
Route::post('managerlogin','AndroidController@managerlogin');
Route::get('managerprofile/{mid}','AndroidController@managerprofile');
Route::get('newusers','AndroidController@newusers');
Route::get('userapprove/{uid}','AndroidController@userapprove');
Route::get('user_reject/{uid}','AndroidController@user_reject');
Route::get('offer','AndroidController@offer');
Route::get('billdetails/{uid}','AndroidController@billdetails');
Route::get('musers/{mid}','AndroidController@musers');
Route::get('mshoporder/{mid}','AndroidController@mshoporder');
Route::get('shoporderitems/{oid}','AndroidController@shoporderitems');
Route::get('cart_total/{oid}','AndroidController@cart_total');
Route::get('cart_min_amount','AndroidController@Cart_Minimum_Amount');
