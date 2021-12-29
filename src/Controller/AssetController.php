<?php

namespace Milestone\eBis\Controller;

use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Milestone\eBis\Model\Model;

class AssetController extends Controller
{

  public static array $fileToModel = [
    'auth' => 'User',
    'widget_master' => 'WidgetMaster', 'widgets' => 'Widget', 'widget' => 'UserWidget',
    'pages' => 'Page', 'layouts' => 'Layout', 'sections' => 'Section',
    'company' => 'Company'
  ];

  public static int $cacheMaxAge =  7*24*60*60*1; //Seconds

  public function JS($time,$file, Request $request){
    $class = self::fileToClass($file); $max = $class::max('updated_at') ?: '1900-01-01 00:00:00';
    if($request->hasHeader('if-modified-since')
      && Carbon::parse($request->header('if-modified-since'))->greaterThanOrEqualTo(Carbon::parse($max)))
      return response([],304);
    $key = 'DATA_' . strtoupper($file);
    return self::output($class::all(),$max,$key);
  }

  public function Auth($id,$time,$file,Request $request){
    if(strVal(Auth::id()) !== strVal($id)) return [];
    return $this->JS($time,$file,$request);
  }

  public static function fileToClass($file){ return Str::of(Model::class)->replaceLast('Model',self::$fileToModel[$file])->__toString(); }

  public static function output($data,$last_modified,$key){
    $data = self::outputFormat($data);
    $data = self::outputString($data,$key);
    return self::outputResponse($data,$last_modified);
  }

  public static function outputFormat($data){
    $collection = ($data instanceof Collection) ? $data : collect($data);
    $HEADS = $VALUES = [];
    if($collection->isNotEmpty()){
      $HEADS = array_keys($collection->first()->toArray());
      $VALUES = $collection->map(function($record){ return array_values($record->toArray()); })->toArray();
    }
    return compact('HEADS','VALUES');
  }

  public static function outputString($data,$key){
    return "const $key = " . json_encode($data);
  }

  public static function outputResponse($data, $modified){
    $modified = Carbon::parse($modified);
    return response($data)->setCache(['last_modified' => $modified,'max_age' => self::$cacheMaxAge]);
  }

  public static function JSRoute($file){
    return route('js',self::JSRouteCode($file));
  }
  public static function JSRouteCode($file){
    $class = self::fileToClass($file);
    $time = strtotime($class::max('updated_at') ?: '1900-01-01');
    return [$time,$file];
  }

  public static function JSAuthRoute($file){
    return route('js_auth',self::JSAuthRouteCode($file));
  }
  public static function JSAuthRouteCode($file){
    if(!Auth::check()) return [random_int(120,890),time(),$file]; $id = Auth::id();
    $class = self::fileToClass($file);
    $time = strtotime($class::max('updated_at') ?: '1900-01-01');
    return [$id,$time,$file];
  }
}
