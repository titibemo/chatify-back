<?php

namespace App\EventListener;

use Lexik\Bundle\JWTAuthenticationBundle\Event\AuthenticationFailureEvent;
use Lexik\Bundle\JWTAuthenticationBundle\Response\JWTAuthenticationFailureResponse;
use Symfony\Component\HttpFoundation\JsonResponse;

class AuthenticationFailureListener{

/**
 * @param AuthenticationFailureEvent $event
 */
public function onAuthenticationFailureResponse(AuthenticationFailureEvent $event)
{
    $response = new JWTAuthenticationFailureResponse('email ou Mot de passe incorrect', JsonResponse::HTTP_UNAUTHORIZED);
    $event->setResponse($response);
}

}