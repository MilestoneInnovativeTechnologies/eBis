<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::group([
  'namespace' => '\\Milestone\\eBis\\Controller',
  'middleware' => 'web'
],function(){
  Route::get('/', function(){ return view(Auth::check() ? 'eBis::index' : 'eBis::login'); })->name('login');
  Route::post('/',function (){
    if(!Auth::attempt(request()->only('email','password'))) return redirect()->route('login')->with(['error' => 'Login credential not match!!']);
    return view('eBis::index');
  });

  Route::get('assets/js/{id}/{time}/{file}.js','AssetController@Auth')->name('js_auth');
  Route::get('assets/js/{time}/{file}.js','AssetController@JS')->name('js');

  Route::get('logout',function (){ Auth::logout(); return redirect()->route('login'); })->name('logout');



  /****************** Report Starts ******************/


  Route::view('stockreport','eBis::stockreport');

  Route::post('makereport', "StockController@index");
  Route::post('ajaxStockstatus', "StockController@ajaxStockstatus");
  Route::post('ajaxStockposition', "StockController@ajaxStockposition");



  /****************** Reports End ******************/


  /****************** DEV REFRESH ******************/

  Route::view('refresh','eBis::refresh');
  Route::post('refresh',function(){ return \Milestone\eBis\Controller\SetupController::refresh(); });
});

/****************** API TEST ******************/

Route::group([],function(){
  Route::get('set',function(\Illuminate\Http\Request $request){
    $um = \Milestone\eBis\Model\UserMetric::where($request->only(['user','metric']))->first();
    $attrs = json_decode(\Illuminate\Support\Arr::get($um,'attrs','{}'),true);
    $um->attrs = json_encode(array_merge($attrs,$request->except(['user','metric'])));
    $um->save();
  });
});

