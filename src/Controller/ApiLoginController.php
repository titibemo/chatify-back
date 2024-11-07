<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Attribute\CurrentUser;

class ApiLoginController extends AbstractController
{
    #[Route('/api/login', name: 'api_login', methods: ['POST'])]
    public function login(#[CurrentUser] ?User $user): Response
    {
        // if (null === $user) {
        //     return $this->json([
        //         'message' => 'missing credentials',
        //     ], Response::HTTP_UNAUTHORIZED);
        // }

        // $token = null; // somehow create an API token for $user

        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/ApiLoginController.php',
            'user'  => $user->getUserIdentifier(),
            // 'token' => $token,
        ]);

        // $user = $this->getUser();
        // return $this->json([
        //     // 'username' -> $user->getUsername()
        //     'message' => 'Welcome to your new controller!'
        // ]);
    }
}
