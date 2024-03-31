<?php

namespace App\Ui\Controller\Auth;

use App\Entity\User;
use App\Repository\UserRepository;
use App\Ui\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

final class RegistrationController extends AbstractController
{
    public function __construct(
        private UserRepository $userRepository,
        private UserPasswordHasherInterface $passwordHasher
    ) {
    }

    #[Route('/api/registration', name: 'registration', methods: Request::METHOD_POST)]
    public function __invoke(Request $request): Response
    {
        $body = json_decode($request->getContent(), true);

        if ($this->userRepository->getByEmail($body['email']) !== null) {
            return new JsonResponse(['message' => 'User already exists'], Response::HTTP_CONFLICT);
        }

        $user = new User();
        $user->setEmail($body['email']);
        $plaintextPassword = $body['password'];

        $hashedPassword = $this->passwordHasher->hashPassword(
            $user,
            $plaintextPassword
        );
        $user->setPassword($hashedPassword);

        $user->setRoles(['ROLE_USER']);

        $this->userRepository->save($user);

        return new JsonResponse(['message' => 'User created'], Response::HTTP_CREATED);
    }
}
