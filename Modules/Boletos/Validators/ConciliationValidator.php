<?php

namespace Modules\Boletos\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

class ConciliationValidator extends LaravelValidator
{

    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'file_path' => 'required',
            'payload' => 'required'
        ],
        ValidatorInterface::RULE_UPDATE => [
            'file_path' => 'required',
            'payload' => 'required'
        ],
   ];
}
