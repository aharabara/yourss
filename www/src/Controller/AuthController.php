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

class AuthController extends AbstractController
{
    private ValidatorInterface $validator;

    public function __construct(ValidatorInterface $validator)
    {
        $this->validator = $validator;
    }

    public function login(): Response
    {
        return new Response(null, Response::HTTP_OK);
    }

    public function logout()
    {
        return new Response(null, Response::HTTP_OK);
    }

    public function register(Request $request, SerializerInterface $normalizer, CreateUserHandler $createUserHandler)
    {
        /** @var CreateUserCommand $command */
        $command = $normalizer->deserialize($request->getContent(), CreateUserCommand::class, 'json');
        $constraints = $this->validator->validate($command);
        if ($constraints->count()) {
            $errors = [];
            foreach ($constraints as $constraint) {
                /** @var ConstraintViolationInterface $constraint */
                $errors[$constraint->getPropertyPath()] = $constraint->getMessage();
            }
            return $this->jsonFail($errors);
        }

        try {
            $createUserHandler->handle($command);
            return new Response(null, Response::HTTP_OK);
        } catch (\DomainException $e) {
            return $this->jsonFail([$e->getMessage()]);
        } catch (\Exception $e) {
            return new Response('Cannot create new user', Response::HTTP_BAD_REQUEST);
        }
    }

    public function verify(Request $request, SearchUserHandler $searchUserHandler)
    {
        /** @var SearchUserQuery $query */
        $query = new SearchUserQuery();
        $query->email = $request->query->get('email');
        $constraints = $this->validator->validate($query);
        if ($constraints->count()) {
            $errors = [];
            foreach ($constraints as $constraint) {
                /** @var ConstraintViolationInterface $constraint */
                $errors[$constraint->getPropertyPath()] = $constraint->getMessage();
            }
            return $this->jsonFail($errors);
        }

        try {
            $users = $searchUserHandler->handle($query);
            if(count($users) > 0){
                return new Response(null, Response::HTTP_NOT_FOUND);
            }
            return new Response(null, Response::HTTP_FOUND);
        } catch (\DomainException $e) {
            return $this->jsonFail([$e->getMessage()]);
        } catch (\Exception $e) {
            return new Response('Cannot create new user', Response::HTTP_BAD_REQUEST);
        }
    }



    /**
     * @param array $errors
     * @return JsonResponse
     */
    public function jsonFail(array $errors): JsonResponse
    {
        return new JsonResponse(['error' => $errors], Response::HTTP_BAD_REQUEST);
    }

}