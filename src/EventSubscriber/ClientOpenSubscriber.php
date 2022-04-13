<?php

namespace App\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ViewEvent;
use Symfony\Component\HttpFoundation\Request;
use App\Service\DataHasher;
use ApiPlatform\Core\EventListener\EventPriorities;
use App\Entity\Client;
use Symfony\Component\HttpKernel\KernelEvents;


class ClientOpenSubscriber implements EventSubscriberInterface
{
    private $hasher;
    public function __construct(DataHasher $hasher)
    {
        $this->hasher =$hasher;
    }

    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::VIEW => ['setCreationData',EventPriorities::PRE_WRITE]
        ];
    }
    public function setCreationData(ViewEvent $event)
    {
        $entity = $event->getControllerResult();
        $method = $event->getRequest()->getMethod();

     
        $date =new \DatetimeImmutable();

        if((!$entity instanceof Client) || Request::METHOD_POST !== $method)
        {
            return;
        }
      
        if(!$entity->getCreateAt())
        {
            $entity->setCreateAt($date);
        }
        $uid = $this->hasher->getHashFromObject($entity);
        $entity->setUid($uid);
    }
}
