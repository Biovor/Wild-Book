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
//    public function searchByTitle($input)
//    {
//        $qb = $this->createQueryBuilder('p')
//            ->where('p.title LIKE :input')
//            ->setParameter('input', '%' . $input . '%');
//        return $qb->getQuery()->getResult();
//    }

    public function searchBy($schools = null, $categories = null)
    {

        $qb = $this->createQueryBuilder('p');

        if ($schools !== null) {
            $qb
                ->andWhere('p.school IN (:school)')
                ->setParameter('school', $schools);
        }
        if ($categories !== null) {
            $qb
                ->andWhere('p.category IN (:category)')
                ->setParameter('category', $categories);
        }


//        if ($promotions != null) {
//            $qb
//                ->leftJoin('p.school', 's')
//                ->addSelect('s')
//                ->leftJoin('s.promotions', 'pr', 'pr.school_id = s.id')
//                ->addSelect('pr')
//                ->andWhere('pr.id IN (:promotion)')
//                ->setParameter('promotion', $promotions);
//        }
        return $qb->getQuery()->getResult();

    }

    public function searchByP($promotions)
    {
        $qb = $this->createQueryBuilder('p')
            ->leftJoin('p.school', 's')
            ->addSelect('s')
            ->leftJoin('s.promotions', 'pr', 'pr.school_id = s.id')
            ->addSelect('pr')
            ->where('pr.id IN (:promotion)')
            ->setParameter('promotion', $promotions);
        var_dump($qb->getDQL());

        return $qb->getQuery()->getResult();
    }

    public function searchByC($categories = null)
    {
        $qb = $this->createQueryBuilder('p')
            ->where('p.category IN (:category)')
            ->setParameter('category', $categories);
        return $qb->getQuery()->getResult();
    }

    public function searchByS($schools = null)
    {
        $qb = $this->createQueryBuilder('p')
            ->where('p.school IN (:school)')
            ->setParameter('school', $schools);
        return $qb->getQuery()->getResult();
    }

    public function getLike($input)
    {
        $input = "%" . $input . "%";
        $qb = $this->createQueryBuilder('p')
            ->select('p.title')
            ->where('p.title LIKE :title')
            ->setParameter('title', $input)
            ->getQuery();
        return $qb->getResult();
    }
}
