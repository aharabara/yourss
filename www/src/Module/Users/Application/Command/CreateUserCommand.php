<?php


namespace App\Module\Users\Application\Command;

use Symfony\Component\Validator\Constraints as Assert;

class CreateUserCommand
{

    /**
     * @Assert\NotBlank()
     * @Assert\Email()
     */
    public string $email;

    /**
     * @Assert\NotBlank()
     */
    public string $password;

    /**
     * @Assert\NotBlank()
     * @Assert\IdenticalTo(propertyPath="password")
     */
    public string $repeatPassword;
}