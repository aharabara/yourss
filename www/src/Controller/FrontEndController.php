<?php

namespace App\Controller;

use App\Module\Users\Application\Command\CreateUserCommand;
use App\Module\Users\Application\Handler\CreateUserHandler;
use App\Module\Users\Application\Handler\SearchUserHandler;
use App\Module\Users\Application\Query\SearchUserQuery;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Http\Logout\SessionLogoutHandler;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\ConstraintViolationInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class FrontEndController extends AbstractController
{
    /**
     * @return Response
     */
    public function index(): Response
    {
        return $this->render('base.html.twig');
    }

}