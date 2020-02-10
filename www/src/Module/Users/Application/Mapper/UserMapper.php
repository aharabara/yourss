<?php

namespace App\Module\Users\Application\Mapper;


use App\Module\Users\Application\DTO\UserDTO;
use App\Module\Users\Domain\User;

class UserMapper
{

    /**
     * @param User $user
     * @return UserDTO
     */
    public function toDTO(User $user): UserDTO
    {
        $dto = new UserDTO();
        $dto->id = $user->getId();
        $dto->email = $user->getEmail();
        $dto->roles = $user->getRoles();
        return $dto;
    }

    /**
     * @param UserDTO $dto
     * @return User
     */
    public function toModel(UserDTO $dto): User
    {
        $user = new User();
        $user->setEmail($dto->email);
        $user->setRoles($dto->roles);
        $user->setId($dto->id);
        return $user;
    }

}