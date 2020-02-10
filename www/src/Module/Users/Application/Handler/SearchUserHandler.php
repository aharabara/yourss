<?php

namespace App\Module\Users\Application\Handler;

use App\Module\Users\Application\DTO\UserDTO;
use App\Module\Users\Application\Mapper\UserMapper;
use App\Module\Users\Application\Query\SearchUserQuery;
use App\Module\Users\Infrastructure\Repository\UserRepository;

class SearchUserHandler
{
    private UserRepository $userRepository;
    private UserMapper $userMapper;

    /**
     * CreateUserHandler constructor.
     * @param UserRepository $userRepository
     * @param UserMapper $userMapper
     */
    public function __construct(UserRepository $userRepository, UserMapper $userMapper)
    {
        $this->userRepository = $userRepository;
        $this->userMapper = $userMapper;
    }

    /**
     * @param SearchUserQuery $query
     * @return UserDTO[]
     */
    public function handle(SearchUserQuery $query): array
    {
        $users = $this
            ->userRepository
            ->findBy([
                'email' => $query->email
            ]);

        $usersDTOs = [];
        foreach ($users as $key => $user) {
            $usersDTOs[] = $this->userMapper->toDTO($user);
        }
        return $usersDTOs;
    }

}