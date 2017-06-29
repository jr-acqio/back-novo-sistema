<?php

namespace Modules\Access\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

class PermissionValidator extends LaravelValidator
{

    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'name' => 'required|unique:roles',
            'display_name' => 'required',
            'description' => 'required'
        ],
        ValidatorInterface::RULE_UPDATE => [],
   ];
}
