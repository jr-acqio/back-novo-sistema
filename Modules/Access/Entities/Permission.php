<?php

namespace Modules\Access\Entities;

use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use Zizaco\Entrust\EntrustPermission;

class Permission extends EntrustPermission implements AuditableContract
{
    use Auditable;
    protected $fillable = [];
}
