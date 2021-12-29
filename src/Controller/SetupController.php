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

  /************************************ DEV REFRESH ************************************/

  public static array $backup = ['Group','User','WidgetMaster','Section','Layout','Page','GroupPageLayout','Company','Widget','UserWidget'];

  public static function nameToClass($name){ return Str::of(Model::class)->replaceLast('Model',$name)->__toString(); }

  public static function migrate(){ Artisan::call('migrate',['--path' => 'milestone\\ebis\\migrations']); }

  public static function refresh(){
    $type = \request()->input('type');
    if($type === 'restore') self::restore();
    else self::refreshInstall();
    return redirect()->route('login');
  }

  public static function refreshInstall(){
    $company = Company::all();
    self::install(); self::migrate(); self::seed();
    $company->each(function ($cmp){ $cmp->replicate()->save(); });
  }

  public static function restore(){
    $backup = self::backup();
    self::install(); self::migrate();
    self::restoreData($backup,intval(request()->input('speed')));
  }

  public static function backup(){
    $backup = [];
    foreach (self::$backup as $name) {
      $class = self::nameToClass($name);
      $backup[$name] = $class::all();
    }
    return $backup;
  }

  public static function restoreData($data,$speed){
    foreach ($data as $name => $Collection) {
      $Collection->each(function ($record) use($speed){
        $record->replicate()->save();
        usleep($speed);
      });
    }
  }

}
