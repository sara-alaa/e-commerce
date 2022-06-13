<?php

namespace App\Http\Controllers\Api\User\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use ECommerce\User\Library\UserLibrary;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    protected $userLibrary;

    public function __construct(
        UserLibrary $userLibrary
    )
    {
        $this->userLibrary = $userLibrary;
    }

    public function register(Request $request)
    {
        $user = $this->userLibrary->create($request->all());
        return response()->json(new UserResource($user));
    }
}
