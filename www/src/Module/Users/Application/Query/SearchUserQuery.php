<?php


namespace App\Module\Users\Application\Query;

use Symfony\Component\Validator\Constraints as Assert;

class SearchUserQuery
{
    /**
     * @Assert\NotBlank()
     * @Assert\Email()
     */
    public string $email;
}