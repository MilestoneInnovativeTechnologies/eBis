<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;
use \Milestone\eBis\Controller\SetupController;

Route::group(['middleware' => 'web'],function(){
  Route::view('/', 'eBis::index')->name('index');
  Route::post('/',function() {
    if (!request()->input('code')) return view('eBis::index');
    if(!request()->filled(['customer','package','start','end','database','username','password'])) {
      $response = Http::get('http://milestoneit.net/api/ebis/' . request('code'));
      if($response->status() === 200 && $response->json()) return view('eBis::index', ['data' => $response->json()]);
      else return view('eBis::index', ['error' => 'Response error']);
    }
    return SetupController::setup();
  });
});
