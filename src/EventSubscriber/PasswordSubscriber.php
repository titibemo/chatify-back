<?php

namespace App\EventSubscriber;

use App\Entity\User;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\HttpKernel\Event\ViewEvent;
use ApiPlatform\Symfony\EventListener\EventPriorities;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class PasswordSubscriber implements EventSubscriberInterface{

    public function __construct(private UserPasswordHasherInterface $userPasswordHasherInterface){}

    public function hashPassword(ViewEvent $event): void{


        $entity = $event->getControllerResult();
        $method = $event->getRequest()->getMethod();
        // dd($entity);
        // dump($method);

        if(!$entity instanceof User || $method !== Request::METHOD_POST){
            return;
        }

        $hashedPassword = $this->userPasswordHasherInterface->hashPassword(
            $entity, $entity->getPassword()
        );
        $entity->setPassword($hashedPassword);

    }

    public static function getSubscribedEvents(): array
    {
        return[
            KernelEvents::VIEW => ['hashPassword', EventPriorities::PRE_WRITE]
        ];
    }

}