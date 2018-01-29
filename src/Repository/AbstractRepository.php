<?php

namespace App\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Pagerfanta\Adapter\DoctrineORMAdapter;
use Pagerfanta\Pagerfanta;

abstract class AbstractRepository extends ServiceEntityRepository
{
    /**
     * Paginate the given query by adding offset and limit
     *
     * @param  QueryBuilder $qb
     * @param  integer      [$limit=20]
     * @param  integer      [$offset=0]
     * @return Pagerfanta
     */
    protected function paginate(QueryBuilder $qb, $limit = 20, $offset = 0)
    {
        if (0 == $limit) {
            throw new \LogicException('$limit must be greater than 0.');
        }

        $pager = new Pagerfanta(new DoctrineORMAdapter($qb));
        $currentPage = ceil(($offset + 1) / $limit);
        // Important : setMaxPerPage MUST be set before setting the current page
        // otherwise Pagerfanta will deduce the nb of page based on the
        // default max per page
        $pager->setMaxPerPage((int) $limit);

        $pager->setCurrentPage($currentPage);

        return $pager;
    }
}
