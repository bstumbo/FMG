<?php

namespace GameManager\Models;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use Doctrine\ODM\MongoDB\Mapping\Driver\AnnotationDriver;
use Zend\Form\Annotation;

/**
 * @Annotation\Hydrator("Zend\Stdlib\Hydrator\ClassMethods")
 * @Annotation\Name("Team")
 */
 
 /** @ODM\Document */
 class Team {
    /**
     * @Annotation\Exclude()
     * @ODM\Id
     */
    
    public $id;
    
    /**
     * @var string
     * 
     * @Annotation\Type("Zend\Form\Element\Text")
     * @Annotation\Required(true)
     * @Annotation\Options({"label":"Team Name:"})
     * @ODM\Field(type="string")
     
     */
     
    public $teamname;
    
    /**
     * @var string
     * 
     * @Annotation\Type("Zend\Form\Element\Select")
     * @Annotation\Options({"label":"Sport:"})
     * @Annotation\Required(true)
     * @ODM\Field(type="string")
     
     */
    
    public $sport;
    
    /**
     * @var string
     * 
     * @Annotation\Type("Zend\Form\Element\Select")
     * @Annotation\Options({"label":"League:"})
     * @Annotation\Required(true)
     * @ODM\Field(type="string")
     
     */
    
    public $league;
    
    /**
     * @Annotation\Type("Zend\Form\Element\Submit")
     * @Annotation\Attributes({"value":"Submit"})
     * 
     */
     
     public $submit;
     
     // Functions Begin
    
    //Setters and Getters
     public function getTeamid() {return $this->id;}
     
     public function getTeamname() {return $this->teamname; }
     public function setTeamname($teamname) { $this->teamname = $teamname; }
     
     public function getSport() {return $this->sport; }
     public function setSport($sport) { $this->sport = $sport; }
     
     public function getLeague() {return $this->league; }
     public function setLeague($league) { $this->league = $league; }
     
     
 }