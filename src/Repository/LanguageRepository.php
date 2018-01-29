<?php

namespace App\Repository;

use App\Entity\Language;
use App\Repository\AbstractRepository;
use App\Helpers\QueryParams\LanguageParams;
use Symfony\Bridge\Doctrine\RegistryInterface;

class LanguageRepository extends AbstractRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Language::class);
    }

    /**
     * @param  string  [$type=null] If provided limit persons to a type (see LanguageParams::TYPE_*)
     * @param  string  [$query=null] If provided try to match the begining of the label
     * @param  string  [$order='asc']
     * @param  integer [$limit=20]
     * @param  integer [$offset=0]
     *
     * @return Pagerfanta
     */
    public function search($type = null, $query = null, $order = 'asc', $limit = 20, $offset = 0)
    {

        $qb = $this->createQueryBuilder('l')
            ->orderBy('l.label', $order);

        if (!empty($query)) {
            $qb->andWhere('l.label LIKE :label')->setParameter('label', $query . '%');
        }

        if (!empty($type)) {
            if ($type === LanguageParams::TYPE_ACTIVE) {
                $qb->andWhere('l.isActive = :is_active')->setParameter('is_active', true);
            } else if ($type === LanguageParams::TYPE_INACTIVE) {
                $qb->andWhere('l.isActive = :is_active')->setParameter('is_active', false);
            }
        }

        return $this->paginate($qb, $limit, $offset);
    }

    /*
    public function findBySomething($value)
    {
        return $this->createQueryBuilder('l')
            ->where('l.something = :value')->setParameter('value', $value)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */
}
