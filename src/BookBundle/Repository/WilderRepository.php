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
    public function searchByName($input)
    {
        $qb = $this->createQueryBuilder('w')
            ->where('w.firstname LIKE :input')
            ->setParameter('input','%'.$input.'%');
        return $qb->getQuery()->getResult();
    }
    public function searchBy($languages)
    {
        $qb = $this->createQueryBuilder('w')
            ->join('w.language','l')
            ->addSelect('l')
            ->where('w.id = :id')
            ->setParameter('id', $languages);
        return $qb->getQuery()->getResult();
    }
    public function getLike($input)
    {
        $input = "%" . $input . "%";
        $qb = $this->createQueryBuilder('w')
            ->select('w.firstname','w.lastname')
            ->where('w.lastname LIKE :lastname')
            ->orWhere('w.firstname LIKE :firstname')
            ->setParameter('firstname',$input)
            ->setParameter('lastname',$input)
            ->getQuery();
        return $qb->getResult(); }
}