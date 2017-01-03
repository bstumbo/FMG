<?php

namespace GameManager\Tables\Factories;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Stdlib\Hydrator\ArraySerializable;
use GameManager\Models\Bar;
use Zend\Db\ResultSet\HydratingResultSet;
use Zend\Db\TableGateway\TableGateway;

class BarTableGatewayFactory implements FactoryInterface
{
    public function createService(
        ServiceLocatorInterface $serviceLocator
    ){
        $dbAdapter = $serviceLocator->get('doctrine.documentmanager.odm_default');
        $hydrator = new ArraySerializable();
        $rowObjectPrototype = new Bar();
        $resultSet = new HydratingResultSet(
            $hydrator, $rowObjectPrototype
        );
        return new TableGateway(
            'findmygame', $dbAdapter, null, $resultSet
        );
    }
}
