<?php

namespace Milestone\eBis\Model;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class Page extends Model
{
    protected static function booted() {
        parent::booted();
        if (Auth::check() && Auth::user()->group) {
            static::addGlobalScope('auth', function (Builder $builder) {
                $builder->has('Groups');
            });
        }
    }

    protected $hidden = ['created_at','updated_at'];
    protected $appends = ['layout'];

    public function Groups(){ return $this->belongsToMany(Group::class,'group_page_layouts','page','group'); }
    public function getLayoutAttribute(){ return (Auth::check() && Auth::user()->group) ? Arr::get(GroupPageLayout::where(['group' => Auth::user()->group,'page' => $this->attributes['id']])->first(),'layout',null) : null; }
}
