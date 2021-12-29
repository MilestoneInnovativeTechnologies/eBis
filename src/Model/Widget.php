<?php

namespace Milestone\eBis\Model;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Staudenmeir\EloquentJsonRelations\HasJsonRelationships;

class Widget extends Model
{
    use HasJsonRelationships;

    protected static function booted() {
        if (Auth::check() && Auth::user()->group) {
            static::addGlobalScope('auth', function (Builder $builder) {
                $builder->has('Groups');
            });
        }
    }

    protected $hidden = ['created_at', 'updated_at'];
    protected $casts = ['groups' => 'json'];

    public function Groups() { return $this->belongsToJson(Group::class, 'groups', 'id'); }
}
