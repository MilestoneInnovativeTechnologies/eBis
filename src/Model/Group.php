<?php

namespace Milestone\eBis\Model;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class Group extends Model
{

    protected static function boot() {
        parent::boot();
        if (Auth::check() && Auth::user()->group) {
            static::addGlobalScope('auth', function (Builder $builder) {
                $builder->where('id', Auth::user()->group);
            });
        }
    }

    public function Users() { return $this->hasMany(User::class, 'group', 'id'); }
    public function Pages() { return $this->belongsToMany(Page::class, 'group_page_layouts', 'group', 'page'); }
}
