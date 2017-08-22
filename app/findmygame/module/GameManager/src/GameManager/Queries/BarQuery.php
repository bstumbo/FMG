<?php

namespace GameManager\Queries;

use GameManager\Models\Bar;
use Zend\Mvc\Controller\AbstractActionController;
use GoogleMapsTools\Api\Geocode;
use GoogleMapsTools\Api\Distancematrix;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineObjectHydrator;
use Doctrine\ODM\MongoDB\Mapping\Driver\AnnotationDriver;
use DoctrineODMModule\Stdlib\Hydrator\DoctrineEntity;
use DoctrineODMModule\Form\Annotation\AnnotationBuilder as DoctrineAnnotationBuilder;

class BarQuery {

const DATETIME_FORMAT = 'Y-m-d';

public function barsearch() {
		
		
		$geocode = new Geocode($_POST['Location']);
		$geocode->execute();
		$userlocation = $geocode->getFirstPoint();
		
		$query = array();
		
		if ($_POST['sports'] != "NULL"){
				
			$query['sports'] = $_POST['sports'];
			
		} else {
				
		$sports = NULL;
		
		}
		
		if ($_POST['leagues'] != "NULL"){
			
			$query['leagues'] = $_POST['leagues'];
				
		} else {
		
		   $leagues = NULL;
		}
		
		if ($_POST['affiliations'] != "NULL"){
			
			$query['affiliations'] = $_POST['affiliations'];	
			
		} else {
		
		   $affiliations = NULL;
		}
		
		
		global $repository;

		$bars = $repository->findBy($query);
	
		global $data;
		global $featured;
		
		$data = array();
		$featured = array();
		
		foreach ($bars as $bar) {
		  
		 $barlocation = $bar->point;
		 
		 $dmatrix = new Distancematrix($userlocation, $barlocation);
		 $result = $dmatrix->fetch();
		 
		 $distance = $result['distance'];
		 
		 if ($_POST['affiliations'] != "NULL") {
			if ($distance < 16093 && $bar->featured == true) {
			       $featured[] = $bar;
			}
			elseif ($distance < 16093) {
			       $data[] = $bar;
			}
		 } else {
			if ($distance < 16093) {
				$data[] = $bar;
			       
			}
		    }
		}
	
	return array($featured, $data);

	}

}
