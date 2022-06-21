<?php

namespace ECommerce\Order\Support\Validation;

use Illuminate\Contracts\Validation\Factory as ValidationFactory;

class OrderValidator
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
            'products' => 'array',
            'products.*' => 'array',
            'products.*.id' => 'required|exists:products,id',
            'products.*.quantity' => 'required|integer'
        ];
    }

    protected function setCreateRules()
    {
        return $this->rules;
    }

    public function validate($attributes)
    {
        $this->validationFactory->make($attributes, $this->setCreateRules())->validate();
    }
}
