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
class GameManagerModelsBarHydrator implements HydratorInterface
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

        /** @Field(type="id") */
        if (isset($data['_id']) || (! empty($this->class->fieldMappings['id']['nullable']) && array_key_exists('_id', $data))) {
            $value = $data['_id'];
            if ($value !== null) {
                $return = $value instanceof \MongoId ? (string) $value : $value;
            } else {
                $return = null;
            }
            $this->class->reflFields['id']->setValue($document, $return);
            $hydratedData['id'] = $return;
        }

        /** @Field(type="string") */
        if (isset($data['name']) || (! empty($this->class->fieldMappings['name']['nullable']) && array_key_exists('name', $data))) {
            $value = $data['name'];
            if ($value !== null) {
                $return = (string) $value;
            } else {
                $return = null;
            }
            $this->class->reflFields['name']->setValue($document, $return);
            $hydratedData['name'] = $return;
        }

        /** @Field(type="string") */
        if (isset($data['location']) || (! empty($this->class->fieldMappings['location']['nullable']) && array_key_exists('location', $data))) {
            $value = $data['location'];
            if ($value !== null) {
                $return = (string) $value;
            } else {
                $return = null;
            }
            $this->class->reflFields['location']->setValue($document, $return);
            $hydratedData['location'] = $return;
        }

        /** @Field(type="string") */
        if (isset($data['hours']) || (! empty($this->class->fieldMappings['hours']['nullable']) && array_key_exists('hours', $data))) {
            $value = $data['hours'];
            if ($value !== null) {
                $return = (string) $value;
            } else {
                $return = null;
            }
            $this->class->reflFields['hours']->setValue($document, $return);
            $hydratedData['hours'] = $return;
        }

        /** @Field(type="string") */
        if (isset($data['phone']) || (! empty($this->class->fieldMappings['phone']['nullable']) && array_key_exists('phone', $data))) {
            $value = $data['phone'];
            if ($value !== null) {
                $return = (string) $value;
            } else {
                $return = null;
            }
            $this->class->reflFields['phone']->setValue($document, $return);
            $hydratedData['phone'] = $return;
        }

        /** @Field(type="string") */
        if (isset($data['website']) || (! empty($this->class->fieldMappings['website']['nullable']) && array_key_exists('website', $data))) {
            $value = $data['website'];
            if ($value !== null) {
                $return = (string) $value;
            } else {
                $return = null;
            }
            $this->class->reflFields['website']->setValue($document, $return);
            $hydratedData['website'] = $return;
        }

        /** @Field(type="string") */
        if (isset($data['bardescription']) || (! empty($this->class->fieldMappings['bardescription']['nullable']) && array_key_exists('bardescription', $data))) {
            $value = $data['bardescription'];
            if ($value !== null) {
                $return = (string) $value;
            } else {
                $return = null;
            }
            $this->class->reflFields['bardescription']->setValue($document, $return);
            $hydratedData['bardescription'] = $return;
        }

        /** @Field(type="string") */
        if (isset($data['barimage']) || (! empty($this->class->fieldMappings['barimage']['nullable']) && array_key_exists('barimage', $data))) {
            $value = $data['barimage'];
            if ($value !== null) {
                $return = (string) $value;
            } else {
                $return = null;
            }
            $this->class->reflFields['barimage']->setValue($document, $return);
            $hydratedData['barimage'] = $return;
        }

        /** @Field(type="string") */
        if (isset($data['facebook']) || (! empty($this->class->fieldMappings['facebook']['nullable']) && array_key_exists('facebook', $data))) {
            $value = $data['facebook'];
            if ($value !== null) {
                $return = (string) $value;
            } else {
                $return = null;
            }
            $this->class->reflFields['facebook']->setValue($document, $return);
            $hydratedData['facebook'] = $return;
        }

        /** @Field(type="string") */
        if (isset($data['twitter']) || (! empty($this->class->fieldMappings['twitter']['nullable']) && array_key_exists('twitter', $data))) {
            $value = $data['twitter'];
            if ($value !== null) {
                $return = (string) $value;
            } else {
                $return = null;
            }
            $this->class->reflFields['twitter']->setValue($document, $return);
            $hydratedData['twitter'] = $return;
        }

        /** @Field(type="string") */
        if (isset($data['snapchat']) || (! empty($this->class->fieldMappings['snapchat']['nullable']) && array_key_exists('snapchat', $data))) {
            $value = $data['snapchat'];
            if ($value !== null) {
                $return = (string) $value;
            } else {
                $return = null;
            }
            $this->class->reflFields['snapchat']->setValue($document, $return);
            $hydratedData['snapchat'] = $return;
        }

        /** @Field(type="string") */
        if (isset($data['instagram']) || (! empty($this->class->fieldMappings['instagram']['nullable']) && array_key_exists('instagram', $data))) {
            $value = $data['instagram'];
            if ($value !== null) {
                $return = (string) $value;
            } else {
                $return = null;
            }
            $this->class->reflFields['instagram']->setValue($document, $return);
            $hydratedData['instagram'] = $return;
        }

        /** @Field(type="collection") */
        if (isset($data['affiliations']) || (! empty($this->class->fieldMappings['affiliations']['nullable']) && array_key_exists('affiliations', $data))) {
            $value = $data['affiliations'];
            if ($value !== null) {
                $return = $value;
            } else {
                $return = null;
            }
            $this->class->reflFields['affiliations']->setValue($document, $return);
            $hydratedData['affiliations'] = $return;
        }

        /** @Field(type="collection") */
        if (isset($data['leagues']) || (! empty($this->class->fieldMappings['leagues']['nullable']) && array_key_exists('leagues', $data))) {
            $value = $data['leagues'];
            if ($value !== null) {
                $return = $value;
            } else {
                $return = null;
            }
            $this->class->reflFields['leagues']->setValue($document, $return);
            $hydratedData['leagues'] = $return;
        }

        /** @Field(type="collection") */
        if (isset($data['sports']) || (! empty($this->class->fieldMappings['sports']['nullable']) && array_key_exists('sports', $data))) {
            $value = $data['sports'];
            if ($value !== null) {
                $return = $value;
            } else {
                $return = null;
            }
            $this->class->reflFields['sports']->setValue($document, $return);
            $hydratedData['sports'] = $return;
        }

        /** @Field(type="boolean") */
        if (isset($data['featured']) || (! empty($this->class->fieldMappings['featured']['nullable']) && array_key_exists('featured', $data))) {
            $value = $data['featured'];
            if ($value !== null) {
                $return = (bool) $value;
            } else {
                $return = null;
            }
            $this->class->reflFields['featured']->setValue($document, $return);
            $hydratedData['featured'] = $return;
        }

        /** @Field(type="int") */
        if (isset($data['vibe']) || (! empty($this->class->fieldMappings['vibe']['nullable']) && array_key_exists('vibe', $data))) {
            $value = $data['vibe'];
            if ($value !== null) {
                $return = (int) $value;
            } else {
                $return = null;
            }
            $this->class->reflFields['vibe']->setValue($document, $return);
            $hydratedData['vibe'] = $return;
        }

        /** @Field(type="int") */
        if (isset($data['ageappropriate']) || (! empty($this->class->fieldMappings['ageappropriate']['nullable']) && array_key_exists('ageappropriate', $data))) {
            $value = $data['ageappropriate'];
            if ($value !== null) {
                $return = (int) $value;
            } else {
                $return = null;
            }
            $this->class->reflFields['ageappropriate']->setValue($document, $return);
            $hydratedData['ageappropriate'] = $return;
        }

        /** @Field(type="string") */
        if (isset($data['televisions']) || (! empty($this->class->fieldMappings['televisions']['nullable']) && array_key_exists('televisions', $data))) {
            $value = $data['televisions'];
            if ($value !== null) {
                $return = (string) $value;
            } else {
                $return = null;
            }
            $this->class->reflFields['televisions']->setValue($document, $return);
            $hydratedData['televisions'] = $return;
        }

        /** @Field(type="int") */
        if (isset($data['outdoorseating']) || (! empty($this->class->fieldMappings['outdoorseating']['nullable']) && array_key_exists('outdoorseating', $data))) {
            $value = $data['outdoorseating'];
            if ($value !== null) {
                $return = (int) $value;
            } else {
                $return = null;
            }
            $this->class->reflFields['outdoorseating']->setValue($document, $return);
            $hydratedData['outdoorseating'] = $return;
        }

        /** @Field(type="int") */
        if (isset($data['capacity']) || (! empty($this->class->fieldMappings['capacity']['nullable']) && array_key_exists('capacity', $data))) {
            $value = $data['capacity'];
            if ($value !== null) {
                $return = (int) $value;
            } else {
                $return = null;
            }
            $this->class->reflFields['capacity']->setValue($document, $return);
            $hydratedData['capacity'] = $return;
        }

        /** @Field(type="int") */
        if (isset($data['type']) || (! empty($this->class->fieldMappings['type']['nullable']) && array_key_exists('type', $data))) {
            $value = $data['type'];
            if ($value !== null) {
                $return = (int) $value;
            } else {
                $return = null;
            }
            $this->class->reflFields['type']->setValue($document, $return);
            $hydratedData['type'] = $return;
        }

        /** @Field(type="string") */
        if (isset($data['staples']) || (! empty($this->class->fieldMappings['staples']['nullable']) && array_key_exists('staples', $data))) {
            $value = $data['staples'];
            if ($value !== null) {
                $return = (string) $value;
            } else {
                $return = null;
            }
            $this->class->reflFields['staples']->setValue($document, $return);
            $hydratedData['staples'] = $return;
        }

        /** @Field(type="string") */
        if (isset($data['menu']) || (! empty($this->class->fieldMappings['menu']['nullable']) && array_key_exists('menu', $data))) {
            $value = $data['menu'];
            if ($value !== null) {
                $return = (string) $value;
            } else {
                $return = null;
            }
            $this->class->reflFields['menu']->setValue($document, $return);
            $hydratedData['menu'] = $return;
        }

        /** @Field(type="int") */
        if (isset($data['foodprices']) || (! empty($this->class->fieldMappings['foodprices']['nullable']) && array_key_exists('foodprices', $data))) {
            $value = $data['foodprices'];
            if ($value !== null) {
                $return = (int) $value;
            } else {
                $return = null;
            }
            $this->class->reflFields['foodprices']->setValue($document, $return);
            $hydratedData['foodprices'] = $return;
        }

        /** @Field(type="int") */
        if (isset($data['happyhour']) || (! empty($this->class->fieldMappings['happyhour']['nullable']) && array_key_exists('happyhour', $data))) {
            $value = $data['happyhour'];
            if ($value !== null) {
                $return = (int) $value;
            } else {
                $return = null;
            }
            $this->class->reflFields['happyhour']->setValue($document, $return);
            $hydratedData['happyhour'] = $return;
        }

        /** @Field(type="string") */
        if (isset($data['hhtime']) || (! empty($this->class->fieldMappings['hhtime']['nullable']) && array_key_exists('hhtime', $data))) {
            $value = $data['hhtime'];
            if ($value !== null) {
                $return = (string) $value;
            } else {
                $return = null;
            }
            $this->class->reflFields['hhtime']->setValue($document, $return);
            $hydratedData['hhtime'] = $return;
        }

        /** @Field(type="int") */
        if (isset($data['fullbar']) || (! empty($this->class->fieldMappings['fullbar']['nullable']) && array_key_exists('fullbar', $data))) {
            $value = $data['fullbar'];
            if ($value !== null) {
                $return = (int) $value;
            } else {
                $return = null;
            }
            $this->class->reflFields['fullbar']->setValue($document, $return);
            $hydratedData['fullbar'] = $return;
        }

        /** @Field(type="string") */
        if (isset($data['drinkspecials']) || (! empty($this->class->fieldMappings['drinkspecials']['nullable']) && array_key_exists('drinkspecials', $data))) {
            $value = $data['drinkspecials'];
            if ($value !== null) {
                $return = (string) $value;
            } else {
                $return = null;
            }
            $this->class->reflFields['drinkspecials']->setValue($document, $return);
            $hydratedData['drinkspecials'] = $return;
        }

        /** @Field(type="int") */
        if (isset($data['barnumber']) || (! empty($this->class->fieldMappings['barnumber']['nullable']) && array_key_exists('barnumber', $data))) {
            $value = $data['barnumber'];
            if ($value !== null) {
                $return = (int) $value;
            } else {
                $return = null;
            }
            $this->class->reflFields['barnumber']->setValue($document, $return);
            $hydratedData['barnumber'] = $return;
        }

        /** @Field(type="int") */
        if (isset($data['publictrans']) || (! empty($this->class->fieldMappings['publictrans']['nullable']) && array_key_exists('publictrans', $data))) {
            $value = $data['publictrans'];
            if ($value !== null) {
                $return = (int) $value;
            } else {
                $return = null;
            }
            $this->class->reflFields['publictrans']->setValue($document, $return);
            $hydratedData['publictrans'] = $return;
        }

        /** @Field(type="string") */
        if (isset($data['trainstation']) || (! empty($this->class->fieldMappings['trainstation']['nullable']) && array_key_exists('trainstation', $data))) {
            $value = $data['trainstation'];
            if ($value !== null) {
                $return = (string) $value;
            } else {
                $return = null;
            }
            $this->class->reflFields['trainstation']->setValue($document, $return);
            $hydratedData['trainstation'] = $return;
        }

        /** @Field(type="int") */
        if (isset($data['parking']) || (! empty($this->class->fieldMappings['parking']['nullable']) && array_key_exists('parking', $data))) {
            $value = $data['parking'];
            if ($value !== null) {
                $return = (int) $value;
            } else {
                $return = null;
            }
            $this->class->reflFields['parking']->setValue($document, $return);
            $hydratedData['parking'] = $return;
        }

        /** @Field(type="int") */
        if (isset($data['parkingtype']) || (! empty($this->class->fieldMappings['parkingtype']['nullable']) && array_key_exists('parkingtype', $data))) {
            $value = $data['parkingtype'];
            if ($value !== null) {
                $return = (int) $value;
            } else {
                $return = null;
            }
            $this->class->reflFields['parkingtype']->setValue($document, $return);
            $hydratedData['parkingtype'] = $return;
        }

        /** @Field(type="string") */
        if (isset($data['tvspecials']) || (! empty($this->class->fieldMappings['tvspecials']['nullable']) && array_key_exists('tvspecials', $data))) {
            $value = $data['tvspecials'];
            if ($value !== null) {
                $return = (string) $value;
            } else {
                $return = null;
            }
            $this->class->reflFields['tvspecials']->setValue($document, $return);
            $hydratedData['tvspecials'] = $return;
        }

        /** @Field(type="int") */
        if (isset($data['tvchange']) || (! empty($this->class->fieldMappings['tvchange']['nullable']) && array_key_exists('tvchange', $data))) {
            $value = $data['tvchange'];
            if ($value !== null) {
                $return = (int) $value;
            } else {
                $return = null;
            }
            $this->class->reflFields['tvchange']->setValue($document, $return);
            $hydratedData['tvchange'] = $return;
        }

        /** @Field(type="string") */
        if (isset($data['music']) || (! empty($this->class->fieldMappings['music']['nullable']) && array_key_exists('music', $data))) {
            $value = $data['music'];
            if ($value !== null) {
                $return = (string) $value;
            } else {
                $return = null;
            }
            $this->class->reflFields['music']->setValue($document, $return);
            $hydratedData['music'] = $return;
        }

        /** @Field(type="string") */
        if (isset($data['dj']) || (! empty($this->class->fieldMappings['dj']['nullable']) && array_key_exists('dj', $data))) {
            $value = $data['dj'];
            if ($value !== null) {
                $return = (string) $value;
            } else {
                $return = null;
            }
            $this->class->reflFields['dj']->setValue($document, $return);
            $hydratedData['dj'] = $return;
        }

        /** @Field(type="string") */
        if (isset($data['otherbar']) || (! empty($this->class->fieldMappings['otherbar']['nullable']) && array_key_exists('otherbar', $data))) {
            $value = $data['otherbar'];
            if ($value !== null) {
                $return = (string) $value;
            } else {
                $return = null;
            }
            $this->class->reflFields['otherbar']->setValue($document, $return);
            $hydratedData['otherbar'] = $return;
        }

        /** @Field(type="int") */
        if (isset($data['dresscode']) || (! empty($this->class->fieldMappings['dresscode']['nullable']) && array_key_exists('dresscode', $data))) {
            $value = $data['dresscode'];
            if ($value !== null) {
                $return = (int) $value;
            } else {
                $return = null;
            }
            $this->class->reflFields['dresscode']->setValue($document, $return);
            $hydratedData['dresscode'] = $return;
        }

        /** @Field(type="string") */
        if (isset($data['notes']) || (! empty($this->class->fieldMappings['notes']['nullable']) && array_key_exists('notes', $data))) {
            $value = $data['notes'];
            if ($value !== null) {
                $return = (string) $value;
            } else {
                $return = null;
            }
            $this->class->reflFields['notes']->setValue($document, $return);
            $hydratedData['notes'] = $return;
        }

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

        /** @EmbedOne */
        if (isset($data['point'])) {
            $embeddedDocument = $data['point'];
            $className = $this->unitOfWork->getClassNameForAssociation($this->class->fieldMappings['point'], $embeddedDocument);
            $embeddedMetadata = $this->dm->getClassMetadata($className);
            $return = $embeddedMetadata->newInstance();

            $this->unitOfWork->setParentAssociation($return, $this->class->fieldMappings['point'], $document, 'point');

            $embeddedData = $this->dm->getHydratorFactory()->hydrate($return, $embeddedDocument, $hints);
            $embeddedId = $embeddedMetadata->identifier && isset($embeddedData[$embeddedMetadata->identifier]) ? $embeddedData[$embeddedMetadata->identifier] : null;

            if (empty($hints[Query::HINT_READ_ONLY])) {
                $this->unitOfWork->registerManaged($return, $embeddedId, $embeddedData);
            }

            $this->class->reflFields['point']->setValue($document, $return);
            $hydratedData['point'] = $return;
        }
        return $hydratedData;
    }
}