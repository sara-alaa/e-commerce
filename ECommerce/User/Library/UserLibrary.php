<?php

namespace ECommerce\User\Library;

use ECommerce\User\Repositories\Contracts\UserRepositoryInterface;
use ECommerce\User\Support\Validation\RegisterValidator;

class UserLibrary
{
    public $userRepository;
    public $registerValidator;

    public function __construct(UserRepositoryInterface $userRepository,
                                RegisterValidator $registerValidator
    )
    {
        $this->userRepository = $userRepository;
        $this->registerValidator = $registerValidator;
    }

    public function create($attributes)
    {
        $attributes = $this->formatAndValidateAttributes(
            $attributes, $this->getFillableAttributesForCreate()
        );
        $user = $this->userRepository->create($attributes);
        return $user;
    }

    protected function formatAndValidateAttributes($attributes)
    {
        $this->registerValidator->validate($attributes);
        return $attributes;
    }

    protected function getFillableAttributesForCreate()
    {
        return [
            'name', 'email', 'password'
        ];
    }
}
