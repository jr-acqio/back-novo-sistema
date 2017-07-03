<?php

namespace Modules\Access\Entities;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use OwenIt\Auditing\Auditable;
use \OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class User extends Authenticatable implements AuditableContract
{
    use Notifiable, Auditable, EntrustUserTrait, SoftDeletes
    {
        SoftDeletes::restore insteadof EntrustUserTrait;
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $dates = ['deleted_at'];

    public function resolveUserId()
    {
        return request()->user() ? request()->user()->id : null;
    }
}
