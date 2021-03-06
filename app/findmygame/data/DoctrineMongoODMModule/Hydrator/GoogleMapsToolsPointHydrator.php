<?php

namespace DoctrineMongoODMModule\Hydrator;

use Doctrine\ODM\MongoDB\DocumentManager;
use Doctrine\ODM\MongoDB\Mapping\ClassMetadata;
use Doctrine\ODM\MongoDB\Hydrator\HydratorInterface;
use Doctrine\ODM\MongoDB\Query\Query;
use Doctrine\ODM\MongoDB\UnitOfWork;
use Doctrine\ODM\MongoDB\Mapping\ClassMetadataInfo;

/**
 * THIS CLASS WAS GENERATED BY THE DOCTRINE ODM. DO NOT EDIT THIS FILE.
 */
class GoogleMapsToolsPointHydrator implements HydratorInterface
{
    private $dm;
    private $unitOfWork;
    private $class;

    public function __construct(DocumentManager $dm, UnitOfWork $uow, ClassMetadata $class)
    {
        $this->dm = $dm;
        $this->unitOfWork = $uow;
        $this->class = $class;
    }

    public function hydrate($document, $data, array $hints = array())
    {
        $hydratedData = array();

        /** @Field(type="float") */
        if (isset($data['latitude']) || (! empty($this->class->fieldMappings['latitude']['nullable']) && array_key_exists('latitude', $data))) {
            $value = $data['latitude'];
            if ($value !== null) {
                $return = (float) $value;
            } else {
                $return = null;
            }
            $this->class->reflFields['latitude']->setValue($document, $return);
            $hydratedData['latitude'] = $return;
        }

        /** @Field(type="float") */
        if (isset($data['longitude']) || (! empty($this->class->fieldMappings['longitude']['nullable']) && array_key_exists('longitude', $data))) {
            $value = $data['longitude'];
            if ($value !== null) {
                $return = (float) $value;
            } else {
                $return = null;
            }
            $this->class->reflFields['longitude']->setValue($document, $return);
            $hydratedData['longitude'] = $return;
        }

        /** @Field(type="id") */
        if (isset($data['_id']) || (! empty($this->class->fieldMappings['pointid']['nullable']) && array_key_exists('_id', $data))) {
            $value = $data['_id'];
            if ($value !== null) {
                $return = $value instanceof \MongoId ? (string) $value : $value;
            } else {
                $return = null;
            }
            $this->class->reflFields['pointid']->setValue($document, $return);
            $hydratedData['pointid'] = $return;
        }
        return $hydratedData;
    }
}