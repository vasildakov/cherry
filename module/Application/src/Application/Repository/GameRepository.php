<?php

namespace Application\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * GameRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class GameRepository extends EntityRepository
{
	
    public function findAll()
    {
        return $this->findBy(array(), array('id' => 'ASC'));
    }
}
