<?php

namespace App\Module\Users\Application\Handler;

use App\Module\Users\Application\Command\CreateUserCommand;
use App\Module\Users\Application\Query\SearchUserQuery;
use App\Module\Users\Domain\User;
use App\Module\Users\Infrastructure\Repository\UserRepository;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class CreateUserHandler
{
    private UserRepository $userRepository;
    private SearchUserHandler $searchUserHandler;
    private UserPasswordEncoderInterface $passEncoder;

    /**
     * CreateUserHandler constructor.
     * @param UserRepository $userRepository
     * @param SearchUserHandler $searchUserHandler
     * @param UserPasswordEncoderInterface $passEncoder
     */
    public function __construct(
        UserRepository $userRepository, SearchUserHandler $searchUserHandler,
        UserPasswordEncoderInterface $passEncoder
    )
    {
        $this->userRepository = $userRepository;
        $this->searchUserHandler = $searchUserHandler;
        $this->passEncoder = $passEncoder;
    }

    /**
     * @param CreateUserCommand $command
     * @return void
     */
    public function handle(CreateUserCommand $command): void
    {

        $query = new SearchUserQuery();
        $query->email = $command->email;
        $users = $this->searchUserHandler->handle($query);
        if(count($users) > 0){
            throw new \DomainException("User with email '{$command->email}' already exists");
        }

        $user = new User();
        $user->setEmail($command->email);
        $user->setPassword($this->passEncoder->encodePassword($user, $command->password));

        $this->userRepository->save($user);
    }

}