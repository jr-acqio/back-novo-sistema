<?php

namespace Modules\Access\Entities;

use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use Zizaco\Entrust\EntrustRole;

class Role extends EntrustRole implements AuditableContract
{
    use Auditable;
    protected $fillable = [];
}
