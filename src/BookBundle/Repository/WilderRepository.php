<?php
namespace BookBundle\Repository;
/**
 * WilderRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class WilderRepository extends \Doctrine\ORM\EntityRepository
{
    public function searchBy($schools , $languages)
    {
        $qb = $this->createQueryBuilder('w');

        if ($schools !== null) {
            $qb
                ->leftJoin('w.promotion','pr')
                ->addSelect('pr')
                ->leftJoin('pr.school','s','s.id = pr.school_id')
                ->addSelect('s')
                ->andWhere('s.id IN (:school)')
                ->setParameter('school', $schools);
        }
        if ($languages !== null) {
            $qb
                ->leftJoin('w.languages','l')
                ->addSelect('l')
                ->andWhere('l.id IN (:languages)')
                ->setParameter('languages', $languages);
        }
        return $qb->getQuery()->getResult();
    }

    public function getLike($input)
    {
        $input = "%" . $input . "%";
        $qb = $this->createQueryBuilder('w')
            ->select('w.firstname','w.lastname','w.profilPicture','w.id')
            ->where('w.lastname LIKE :lastname')
            ->orWhere('w.firstname LIKE :firstname')
            ->setParameter('firstname',$input)
            ->setParameter('lastname',$input)
            ->getQuery();
        return $qb->getResult();
    }

    public function searchByS($schools)
    {

        $qb = $this->createQueryBuilder('w')
                ->leftJoin('w.promotion','pr')
                ->addSelect('pr')
                ->leftJoin('pr.school','s','s.id = pr.school_id')
                ->addSelect('s')
                ->andWhere('s.id IN (:school)')
                ->setParameter('school', $schools);
        return $qb->getQuery()->getResult();
    }

    public function searchByL($languages)
    {
        $qb = $this->createQueryBuilder('w')
            ->leftJoin('w.languages','l')
            ->addSelect('l')
            ->andWhere('l.id IN (:languages)')
            ->setParameter('languages', $languages);
        return $qb->getQuery()->getResult();
    }
}

