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
    public function searchBy($schools, $languages, $promotions)
    {
        $qb = $this->createQueryBuilder('w');

        if (!$schools->isEmpty()) {
            $qb
                ->leftJoin('w.promotion','pr')
                ->leftJoin('pr.school','s','s.id = pr.school_id')
                ->andWhere('s.id IN (:school)')
                    ->setParameter('school', $schools);
        }
        if (!$languages->isEmpty()) {
            $qb
                ->leftJoin('w.languages','l')
                ->andWhere('l.id IN (:languages)')
                    ->setParameter('languages', $languages);
        }

        if (!$promotions->isEmpty()) {
            $qb
                ->leftJoin('w.promotion','p')
                ->andWhere('p.id IN (:promotion)')
                    ->setParameter('promotion', $promotions);
        }

        return $qb->getQuery()->getResult();
    }

    public function getLike($input)
    {
        $input = "%" . $input . "%";
        $qb = $this->createQueryBuilder('w')
            ->select('w.firstname','w.lastname','w.profilPicture','w.id')
            ->where('w.lastname LIKE :lastname')
                ->setParameter('lastname',$input)
            ->orWhere('w.firstname LIKE :firstname')
                ->setParameter('firstname',$input)
            ->getQuery();
        return $qb->getResult();
    }

    public function getLikeAdmin($input)
    {
        $input = "%" . $input . "%";
        $qb = $this->createQueryBuilder('w')
            ->select('w.firstname','w.lastname','w.profilPicture','w.id','w.userActivation','w.managerActivation','w.city','pr.promotion')
            ->leftJoin('w.promotion','pr')
            ->where('w.lastname LIKE :lastname')
                ->setParameter('lastname',$input)
            ->orWhere('w.firstname LIKE :firstname')
                ->setParameter('firstname',$input)
            ->getQuery();
        return $qb->getResult();
    }

    public function getLikeHomeWilder($input)
    {
        $input = "%" . $input . "%";
        $qb = $this->createQueryBuilder('w')
            ->where('w.lastname LIKE :lastname')
                ->setParameter('lastname', $input)
            ->orWhere('w.firstname LIKE :firstname')
                ->setParameter('firstname', $input)
            ->getQuery();
        return $qb->getResult();
    }
}

