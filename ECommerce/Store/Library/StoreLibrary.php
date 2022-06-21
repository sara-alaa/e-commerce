<?php

namespace ECommerce\Store\Library;

use ECommerce\Store\Repositories\Contracts\StoreRepositoryInterface;
use ECommerce\Store\Support\Validation\StoreValidator;

class StoreLibrary
{
    public $storeRepository;
    public $storeValidator;

    public function __construct(StoreRepositoryInterface $storeRepository,
                                StoreValidator $storeValidator
    )
    {
        $this->storeRepository = $storeRepository;
        $this->storeValidator = $storeValidator;
    }

    public function store($attributes)
    {
        $attributes = $this->formatAndValidateAttributes($attributes);
        $attributes['user_id'] = auth()->id();
        $store = $this->storeRepository->create($attributes);
        return $store;
    }

    public function show($storeId)
    {
        return $this->storeRepository->show($storeId);
    }

    public function update($storeId, $attributes)
    {
        $attributes = $this->formatAndValidateUpdateAttributes($attributes, $storeId);
        $store = $this->storeRepository->update($storeId, $attributes);
        return $store;
    }

    protected function formatAndValidateAttributes($attributes)
    {
        $this->storeValidator->validate($attributes);
        return $attributes;
    }

    protected function formatAndValidateUpdateAttributes($attributes, $id)
    {
        $this->storeValidator->updateValidate($attributes, $id);
        return $attributes;
    }
}
