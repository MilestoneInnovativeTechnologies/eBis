<?php


namespace Milestone\eBis\Seeder;


trait SeederTrait
{
  public static function getData(){
    if(self::$timestamps){
      $date = now()->toDateTimeString();
      array_walk(self::$data,function (&$record,$index,$date){
        array_push($record,$date,$date);
      },$date);
      array_push(self::$fields,'created_at','updated_at');
    }
    $fn = self::getParseFn(self::$fields,self::$jsonIndices);
    return collect(self::$data)->map($fn)->values()->toArray();
  }

  public static function getParseFn($fields,$encode){
    $length = count($fields);
    $fn = function($record) use($fields,$length) {
      $record = array_pad($record,$length,null);
      return array_combine($fields,$record);
    };
    return ($encode && count($encode)) ? function ($record) use($encode,$fn){
      foreach($encode as $index) $record[$index] = $record[$index] ? json_encode($record[$index]) : null;
      return $fn($record);
    } : $fn;
  }
}
