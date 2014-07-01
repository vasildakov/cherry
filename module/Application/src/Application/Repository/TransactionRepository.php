<?php

namespace Application\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * TransactionRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class TransactionRepository extends EntityRepository
{

	public function test() 
	{
		$qb = $this->_em->createQueryBuilder();
        $qb->select('t');
        $qb->from('Application\Entity\Transaction', 't');
        return $qb->getQuery()->getResult();
	}
}
