<?php

namespace ECommerce\User\Support\Validation;

use Illuminate\Contracts\Validation\Factory as ValidationFactory;

class RegisterValidator
{
    protected $validationFactory;
    protected $rules = [];

    public function __construct(ValidationFactory $validationFactory)
    {
        $this->validationFactory = $validationFactory;
        $this->setDefaultRules();
    }

    protected function setDefaultRules()
    {
        $this->rules = [
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
            'role' => 'required|string|in:merchant,consumer'
        ];
    }

    public function validate($attributes)
    {
        $this->validationFactory->make($attributes, $this->rules)->validate();
    }
}
