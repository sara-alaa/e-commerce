<?php

namespace App\Http\Controllers\Api\Store;

use App\Http\Controllers\Controller;
use App\Http\Resources\StoreResource;
use ECommerce\Store\Library\StoreLibrary;
use ECommerce\Store\Store;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    protected $storeLibrary;

    public function __construct(
        StoreLibrary $storeLibrary
    )
    {
        $this->authorizeResource(Store::class, 'store');
        $this->storeLibrary = $storeLibrary;
    }

    public function store(Request $request)
    {
        $store = $this->storeLibrary->store($request->all());
        return response()->json(new StoreResource($store));
    }

    public function update(Store $store, Request $request)
    {
        $store = $this->storeLibrary->update($store->id, $request->all());
        return response()->json(new StoreResource($store));
    }

    public function show(Store $store)
    {
        $store = $this->storeLibrary->show($store->id);
        return response()->json(new StoreResource($store));
    }
}
