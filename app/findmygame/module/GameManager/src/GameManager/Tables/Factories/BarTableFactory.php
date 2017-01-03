<?php

namespace GameManager\Tables\Factories;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use GameManager\Tables\BarTable;

class BarTableFactory implements FactoryInterface
{
    public function createService(
        ServiceLocatorInterface $serviceLocator
    ){
        $tableGateway = $serviceLocator->get(
            'GameManager\Tables\BarTableGateway'
        );
        $table = new BarTable($tableGateway);
        return $table;
    }
}
