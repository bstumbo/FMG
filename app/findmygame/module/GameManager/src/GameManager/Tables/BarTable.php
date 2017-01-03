<?php

namespace GameManager\Tables;

use GameManager\Models\Bar;
use GoogleMapsTools\Api\Geocode;
use GoogleMapsTools\Api\Distancematrix;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineObjectHydrator;
use Doctrine\ODM\MongoDB\Mapping\Driver\AnnotationDriver;
use DoctrineODMModule\Stdlib\Hydrator\DoctrineEntity;
use DoctrineODMModule\Form\Annotation\AnnotationBuilder as DoctrineAnnotationBuilder;
use Zend\Db\TableGateway\TableGateway;


class BarTable
{
    const DATETIME_FORMAT = 'Y-m-d';

    protected $tableGateway;

    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

   public function barsearch() {
		
        $geocode = new Geocode('1432 Pennsylvania Ave. SE, Washington D.C. 20003');
		$geocode->execute();
		$userlocation = $geocode->getFirstPoint();
		
		$query = array('leagues' => array('2'));
		$bars = $repository->findBy($query);
		
		$data = array();
		
		foreach ($bars as $bar) {
		 
		 
		 $barlocation = $bar->point;
		 
		 $dmatrix = new Distancematrix($userlocation, $barlocation);
		 $result = $dmatrix->fetch();
		 
		 $distance = $result['distance'];
		 
		 if ($distance < 16093) {
				
			$data[] = $bar;
		 
		 }
		 	 
	}
	
	return $data;

}

}

