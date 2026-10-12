<?php

namespace App\Repository;

use App\Entity\Materiel;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Materiel>
 */
class MaterielRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Materiel::class);
    }

    /**
     * @return Materiel[]
     */
    public function findAllOrderedByNameASC(): array
    {
        return $this->createQueryBuilder('m')
            ->orderBy('m.name', 'ASC')
            ->getQuery()
            ->getResult();
    }

    public function countAllMateriels(): int
    {
        return $this->createQueryBuilder('c')
        ->select('COUNT(c.id)')
        ->getQuery()
        ->getSingleScalarResult();
    }

    public function countAvailableMateriels(): int
    {
        return (int) $this->createQueryBuilder('c')
        ->select('COUNT(c.id)')
        ->andWhere('c.status = :statut')
        ->setParameter('statut', 'disponible')
        ->getQuery()
        ->getSingleScalarResult();
    }

    public function countByStatus(string $status): int
    {
        return (int) $this->createQueryBuilder('s')
        ->select('COUNT(s.id)')
        ->where('s.status = :statut')
        ->setParameter('statut', $status)
        ->getQuery()
        ->getSingleScalarResult();
    }

    public function countByAllStatus(): array
    {
        return $this->createQueryBuilder('s')
        ->select('s.status,COUNT(s.id) AS total')
        ->groupBy('s.status')
        ->getQuery()
        ->getScalarResult();
    }
}
