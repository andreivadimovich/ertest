<?php

namespace App\Repository;

use Symfony\Bridge\Doctrine\RegistryInterface;
use Doctrine\ORM\EntityRepository;

    class AutoRepository extends EntityRepository
{
    public function updateState($autoId, $state): bool
    {
        $em = $this->getEntityManager();
        $auto = $em->getRepository(\App\Entity\Auto::class)
            ->find($autoId);

        if (!$auto) {
            throw $this->createNotFoundException('No auto found for id '.$autoId);
        }

        $auto->setState($state);
        $em->flush();

        return true;
    }
}