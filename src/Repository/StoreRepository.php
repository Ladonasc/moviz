<?php

namespace App\Repository;

use App\Entity\Store;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

class StoreRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Store::class);
    }

    public function findWithUser()
    {
        // Force the join to avoid multiple select when serializing
        // the response
        $qb = $this->createQueryBuilder('s')
            ->leftJoin('s.userStores', 'user_store')
            ->addSelect('user_store')
            ->leftJoin('user_store.user', 'user')
            ->addSelect('user');

        return $qb
            ->getQuery()
            ->getResult();
    }
    /*
    public function findBySomething($value)
    {
        return $this->createQueryBuilder('s')
            ->where('s.something = :value')->setParameter('value', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */
}
