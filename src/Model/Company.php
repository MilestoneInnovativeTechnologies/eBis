<?php

namespace Milestone\eBis\Model;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class Company extends Model
{
  private static array $restrictedFields = ['database', 'username', 'password'];
  protected static function booted() {
    parent::booted();
    static::addGlobalScope('secure', function (Builder $builder) {
      $builder->whereNotIn('key',self::$restrictedFields);
    });
  }

  protected $hidden = ['created_at','updated_at'];
}
