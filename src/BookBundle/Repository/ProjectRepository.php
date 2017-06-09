<?php

namespace BookBundle\Repository;

/**
 * ProjectRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ProjectRepository extends \Doctrine\ORM\EntityRepository
{
    public function searchByTitle($input)
    {
        $qb = $this->createQueryBuilder('p')
            ->where('p.title LIKE :input')
            ->setParameter('input','%'.$input.'%');
        return $qb->getQuery()->getResult();
    }

    public function searchBy($categories)
    {
        $qb = $this->createQueryBuilder('p')
            ->andWhere('p.category IN (:category)')
            ->setParameter('category', $categories);
        return $qb->getQuery()->getResult();
    }
}
