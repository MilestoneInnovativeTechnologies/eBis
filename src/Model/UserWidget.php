<?php

namespace Milestone\eBis\Model;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class UserWidget extends Model
{
    protected static function booted() {
      parent::booted();
      static::addGlobalScope('auth', function (Builder $builder) {
        if(Auth::user()) $builder->where('user',Auth::id());
      });
    }
}
