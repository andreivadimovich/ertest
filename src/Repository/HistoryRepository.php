<?php

namespace App\Repository;

use Symfony\Bridge\Doctrine\RegistryInterface;
use Doctrine\ORM\EntityRepository;

class HistoryRepository extends EntityRepository
{
    public function dateBeetwen($car_id = null, $date1, $date2): array
    {
        $entityManager = $this->getEntityManager();
        $query = $entityManager->createQuery(
            'SELECT h FROM App\Entity\History h
            WHERE h.took >= :date1
            AND h.gave <= :date2
            AND h.auto = :car_id')
            ->setParameter('date1', $date1)
            ->setParameter('date2', $date2);
        if ($car_id) {
            $query = $query->setParameter('car_id', $car_id);
        }

        return $query->execute();
    }

    public function averageDate($car_id): array
    {
        $entityManager = $this->getEntityManager();
        $query = $entityManager->createQuery('
            SELECT 
                (SELECT d.addr FROM App\Entity\Department d WHERE d.id=h.departmentFrom) AS addr,
                TRIM(\'.0000\' from 
                    SEC_TO_TIME(
                        AVG(
                            unix_timestamp(h.gave)-unix_timestamp(h.took)
                        ) 
                    )
                )
                AS time
            FROM App\Entity\History h
            WHERE h.auto = :car_id
            GROUP BY h.auto, h.departmentFrom
        ')->setParameter('car_id', $car_id);

        return $query->execute();
    }
}