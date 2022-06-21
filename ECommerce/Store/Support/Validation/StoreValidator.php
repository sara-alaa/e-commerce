<?php

namespace ECommerce\Store\Support\Validation;

use Illuminate\Contracts\Validation\Factory as ValidationFactory;
use Illuminate\Validation\Rule;

class StoreValidator
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
            'vat_included' => 'required|boolean',
            'shipping_cost' => 'required|numeric',
        ];
    }

    protected function setCreateRules()
    {
        $this->rules['name'] =
           'required|string|unique:stores,name'
        ;
        return $this->rules;
    }

    protected function setUpdateRules($id)
    {
        $this->rules['name'] = [
            'required',
            'string',
            Rule::unique('stores', 'name')->ignore($id),
        ];
        return $this->rules;
    }

    public function validate($attributes)
    {
        $this->validationFactory->make($attributes, $this->setCreateRules())->validate();
    }

    public function updateValidate($attributes, $storeId)
    {
        $this->validationFactory->make($attributes, $this->setUpdateRules($storeId))->validate();
    }
}
