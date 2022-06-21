<?php

namespace ECommerce\Product\Support\Validation;

use Illuminate\Contracts\Validation\Factory as ValidationFactory;
use Illuminate\Validation\Rule;

class ProductValidator
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
            'order_max_quantity' => 'nullable|integer',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
            'store_id' => 'required|exists:stores,id',
            'name' => 'array',
            'descrption' => 'array',
            'descrption.en' => 'string',
            'descrption.ar' => 'string'
        ];
    }

    protected function setCreateRules()
    {
        return array_merge($this->rules, [
            'name.en' => 'required|string|max:255|unique:products,name->en',
            'name.ar' => 'required|string|max:255|unique:products,name->ar',
        ]);
    }

    protected function setUpdateRules($id)
    {
        return  array_merge($this->rules, [
            'name.en' => ['required', 'string', Rule::unique('products', 'name->en')->ignore($id)],
            'name.ar' => ['required', 'string', Rule::unique('products', 'name->ar')->ignore($id)],
        ]);
    }

    public function validate($attributes)
    {
        $this->validationFactory->make($attributes, $this->setCreateRules())->validate();
    }

    public function updateValidate($attributes, $productId)
    {
        $this->validationFactory->make($attributes, $this->setUpdateRules($productId))->validate();
    }
}
