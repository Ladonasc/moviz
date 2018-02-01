<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

class UserRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, User::class);
    }

    public function searchWithStore($email)
    {
        // Force the join to avoid multiple select when serializing
        // the response
        $qb = $this->createQueryBuilder('u')
            ->leftJoin('u.userStores', 'user_store')
            ->addSelect('user_store')
            ->leftJoin('user_store.store', 'store')
            ->addSelect('store')
            ->orderBy('u.email', 'asc');

        if (!empty($email)) {
            $qb->where('u.email LIKE :value')->setParameter('value', $email . '%');
        }

        return $qb
            ->getQuery()
            ->getResult();
    }

    /*
    public function findBySomething($value)
    {
        return $this->createQueryBuilder('u')
            ->where('u.something = :value')->setParameter('value', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */
}
