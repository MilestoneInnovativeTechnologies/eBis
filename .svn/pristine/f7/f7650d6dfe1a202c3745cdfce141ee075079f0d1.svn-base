<?php

namespace Milestone\eBis\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Milestone\eBis\eBisServiceProvider;
use Milestone\eBis\Model\Company;
use Milestone\eBis\Model\Model;
use Milestone\eBis\Seeder\DatabaseSeeder;

class SetupController extends Controller
{
  public static function install(){ Artisan::call('migrate:fresh'); }
  public static function seed(){ Artisan::call(addslashes('db:seed --class=' . DatabaseSeeder::class)); }

  public static function setup(){
    self::cacheCompany(request()->all());
    self::install(); self::seed();
    self::addCompany(request()->all());
    return redirect()->route('index');
  }

  public static function addCompany($data){
    $created_at = $updated_at = now()->toDateTimeString();
    $data = collect(Arr::except($data,['_token']))->map(function($value,$key)use($created_at,$updated_at){ return compact('key','value','created_at','updated_at'); })->values()->toArray();
    Company::insert($data);
  }

  public static function cacheCompany($data){
    $host = Str::of($data['host'])->replace(['http://','https://'],'')->__toString();
    $data = json_encode(Arr::only($data,['database','username','password']));
    eBisServiceProvider::setConnectionParams($data);
    if(DB::connection()->getPdo()) Storage::put($host,$data);
  }

}
