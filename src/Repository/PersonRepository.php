<?php

namespace App\Repository;

use App\Entity\Person;
use App\Repository\AbstractRepository;
use App\Helpers\QueryParams\PersonParams;
use Symfony\Bridge\Doctrine\RegistryInterface;

class PersonRepository extends AbstractRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Person::class);
    }

    /**
     * @param  string  [$type=null] If provided limit persons to a type (see PersonParams::TYPE_*)
     * @param  string  [$query=null] If provided try to match the begining of identity
     * @param  string  [$order='asc']
     * @param  integer [$limit=20]
     * @param  integer [$offset=0]
     *
     * @return Pagerfanta
     */
    public function search($type = null, $query = null, $order = 'asc', $limit = 20, $offset = 0)
    {

        $qb = $this->createQueryBuilder('p')
            ->orderBy('p.identity', $order);

        if (!empty($query)) {
            $qb->andWhere('p.identity LIKE :identity')->setParameter('identity', $query . '%');
        }

        if (!empty($type)) {
            if ($type === PersonParams::TYPE_ACTOR) {
                $qb->andWhere('p.isActor = :is_actor')->setParameter('is_actor', true);
            }

            if ($type === PersonParams::TYPE_DIRECTOR) {
                $qb->andWhere('p.isDirector = :is_director')->setParameter('is_director', true);
            }
        }

        return $this->paginate($qb, $limit, $offset);
    }

    /*
    public function findBySomething($value)
    {
        return $this->createQueryBuilder('p')
            ->where('p.something = :value')->setParameter('value', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */
}
