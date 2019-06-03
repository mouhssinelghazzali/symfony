<?php

namespace App\Linstner;

use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\PreFlushEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Liip\ImagineBundle\Imagine\Cache\CacheManager;
use Vich\UploaderBundle\Templating\Helper\UploaderHelper;
use App\Entity\Property;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Doctrine\ORM\Event\LifecycleEventArgs;

class  ImageCacheSuscriber implements EventSubscriber
{
    /**
     * @var CacheManager
     */

     private $cacheManager;
     /**
      * @var UploaderHelper
      */


      private $UploaderHelper;


    public function __construct(CacheManager $cacheManager,UploaderHelper $uploaderHelper)
    {
        $this->cacheManager = $cacheManager;
        $this->uploaderHelper = $uploaderHelper;
    }
    public function getSubscribedEvents()
    {
        return [
            'preRemove',
            'preUpdate'
        ];
    }


    public function preRemove(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();
        if(!$entity instanceof Property)
        {
            return;
        }
        $this->cacheManager->remove($this->UploaderHelper->asset($entity,'imageFile'));

    }

    public function preUpdate(PreUpdateEventArgs $args)
    {
        $entity = $args->getEntity();
        if(!$entity instanceof Property)
        {
            return;
        }
        if($entity instanceof UploadedFile)
        {
            $this->cacheManager->remove($this->UploaderHelper->asset($entity,'imageFile'));
        }
        dump($args->getObject());
        dump($args->getEntity());

    }


}


