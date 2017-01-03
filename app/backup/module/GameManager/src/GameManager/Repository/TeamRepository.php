<?php

namespace GameManager\Repository;
 
use Doctrine\ODM\MongoDB\DocumentRepository;

class TeamRepository extends DocumentRepository
{
    public function findTeams()
    {
        $dm = $this->getServiceLocator()->get('doctrine.documentmanager.odm_default');
        
        $qb = $dm->createQueryBuilder('GameManager\Models\Team');
        $qb->findAll();
        $query = $qb->getQuery();
        
        $teams = $query->execute;
        
        return $teams;
		
    }
}