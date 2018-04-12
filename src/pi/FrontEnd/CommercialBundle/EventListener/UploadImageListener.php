<?php
/**
 * Created by PhpStorm.
 * User: Ahmed
 * Date: 07/04/2018
 * Time: 01:26
 */

namespace pi\FrontEnd\CommercialBundle\EventListener;



use pi\FrontEnd\CommercialBundle\Entity\Accessoire;
use pi\FrontEnd\CommercialBundle\Entity\Nourriture;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use pi\FrontEnd\CommercialBundle\Controller\ImageUpload;

class UploadImageListener
{
    private $uploader;

    public function __construct(ImageUpload $uploader)
    {
        $this->uploader = $uploader;
    }

    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        $this->uploadFile($entity);
    }

    public function preUpdate(PreUpdateEventArgs $args)
    {
        $entity = $args->getEntity();

        $this->uploadFile($entity);
    }

    private function uploadFile($entity)
    {
        // upload only works for Product entities
        if ((!$entity instanceof Nourriture)&&(!$entity instanceof Accessoire)) {
            return;
        }

        $file = $entity->getPhoto();

        // only upload new files
        if (!$file instanceof UploadedFile) {
            return;
        }

        $fileName = $this->uploader->upload($file);
        $entity->setPhoto($fileName);
    }
}