<?php

namespace App\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

/**
 * Class RegistrationValidator.
 *
 * @package namespace App\Validators;
 */
class RegistrationValidator extends LaravelValidator
{
    /**
     * Validation Rules
     *
     * @var array
     */
    protected $rules = [

        //Rule for web API
        'register-rule' => [
	        'first_name'    => 'required',
	        'last_name'     => 'required',
	        'username'      => 'required|max:10|min:10',
	        'email'         => 'required|email|unique:users,email'
        ],
        'login-rule' => [
            'email'         => 'required',
	        'password'      => 'required'
        ],
        'blog-rule' => [

            'heading'      => 'required',
            'content'      => 'required'
        ]
        
    ];
    
    protected $messages = [
        'email.unique'          => 'The email has already been taken'
    ];
}
