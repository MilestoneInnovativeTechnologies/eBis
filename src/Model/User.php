<?php

namespace Milestone\eBis\Model;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class User extends \App\Models\User
{
    protected $fillable = ['name', 'email', 'password', 'group'];

    protected static function booted() {
        parent::booted();
        static::addGlobalScope('auth', function (Builder $builder) {
            if (Auth::user()) $builder->where('id', Auth::id());
        });
    }

    public function Group(){ return $this->belongsTo(Group::class,'group','id'); }
    public function Widgets(){ return $this->belongsToMany(Widget::class,'user_widgets','user','widget'); }
}
