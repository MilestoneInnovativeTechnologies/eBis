<?php


namespace Milestone\eBis;


use Exception;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;

trait ServiceProviderTrait
{

  public static string $checkTable = 'companies';
  public static array $requests = ['default','client','setup'];
  public static string $request = '';

  private static function path(...$path){
    return implode(DIRECTORY_SEPARATOR, [__DIR__,'..',...$path]);
  }

  public static function init(){
    self::$request = request()->getHost() === env('DOMAIN') ? 'default' : 'client';
    if(self::$request === 'default') return true;
    $host = request()->getHost();// . '.com';
    if(!Storage::exists($host)) return self::$request = 'setup';
    self::setConnectionParams(Storage::get($host));
    try {
      if(Schema::hasTable(self::$checkTable)) self::$request = 'client';
      else self::$request = 'setup';
    } catch(Exception $e){
      self::$request = 'setup';
    }
    return true;
  }

  public static function setConnectionParams($data){
    $data = json_decode($data,true);
    $connection = config('database.default');
    foreach($data as $key => $value) config()->set("database.connections.$connection.$key",$value);
  }
}
