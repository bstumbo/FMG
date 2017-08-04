<?php

namespace GameManager\Controller\Services;
use Doctrine\ODM\MongoDB\Mapping\Driver\AnnotationDriver;
use DoctrineODMModule\Stdlib\Hydrator\DoctrineEntity;

class AffiliationsRetrieve

{
	
	public function retrieveAff($dm){
		
		/*
		 * Retreive repository of Teams in system
		 * Then return array of all teams, sports and leagues
		 * Used for search forms and content entry forms 
		 */
		
		$affs = $dm->getRepository('GameManager\Models\Team')->findAll();
		
		$affsOptions = [null => ''];
		$leagueOptions = [null => ''];
		$sportOptions = [null => ''];
		
		foreach ($affs as $aff) {
			$affOptions[$aff->getTeamid()] = $aff->getTeamname();
			$leagueOptions[$aff->getLeague()] = $aff->getLeague();
			$sportOptions[$aff->getSport()] = $aff->getSport();
		}
		
		
		/*
		 * Create new arrays for sports and leagues with only unique values
		 * No dups
		 */
		
		$uniLeagueOptions = array_unique($leagueOptions);
		$uniSportOptions = array_unique($sportOptions);
		
		return array($affOptions, $uniLeagueOptions, $uniSportOptions);
	}
}


   
	