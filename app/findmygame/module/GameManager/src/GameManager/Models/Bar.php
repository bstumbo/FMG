<?php

namespace GameManager\Models;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use Doctrine\ODM\MongoDB\Mapping\Driver\AnnotationDriver;
use Zend\Form\Annotation;
use GameManager\Models\Team;
use GoogleMapsTools\Point;
use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

/**
 * @Annotation\Hydrator("Zend\Stdlib\Hydrator\ClassMethods")
 * @Annotation\Name("Bar")
 */
/** @ODM\Document */
class Bar

{    
     /**
     * @Annotation\Exclude()
     * @ODM\Id
     
     */
     
    
    public $id;
    
    protected $inputFilter;
    
      /**
     * @var string
     * 
     * @Annotation\Type("Zend\Form\Element\Text")
     * @Annotation\Required(true)
     * @Annotation\Options({"label":"Name:"})
     * @ODM\Field(type="string")
     
     */
     
    public $name;
    
   /** 
     * @Annotation\Type("Zend\Form\Element\Text")
     * @Annotation\Required(true)
     * @Annotation\Options({"label":"Location:"})
     * @ODM\Field(type="string")
     
     */
    
    public $location;
     
    /**
     * 
     * @Annotation\Type("Zend\Form\Element\Textarea")
     * @Annotation\Required(false)
     * @Annotation\Options({"label":"Hours:" })
    * @Annotation\Attributes({"class":"ckeditor"})
     * @ODM\Field(type="string")
     
     */
    
    public $hours;
    
    /**
     * 
     * @Annotation\Type("Zend\Form\Element\Text")
     * @Annotation\Required(false)
     * @Annotation\Options({"label":"Phone Number:"})
     * @ODM\Field(type="string")
     
     */
    
    public $phone;
    
    /**
     * 
     * @Annotation\Type("Zend\Form\Element\Text")
     * @Annotation\Required(false)
     * @Annotation\Options({"label":"Website Url:"})
     * @ODM\Field(type="string")
     
     */
    
    public $website;
    
    /**
     * @Annotation\Type("Zend\Form\Element\Textarea")
     * @Annotation\Required(false)
     * @Annotation\Options({"label":"Bar Description"})
     * @Annotation\Attributes({"class":"ckeditor"})
     * @ODM\Field(type="string")
     
     */
    
    public $bardescription;
    
    /**
     * 
     * @Annotation\Type("Zend\Form\Element\File")
     * @Annotation\Required(false)
     * @Annotation\Options({"label":"Bar Image"})
     * @ODM\Field(type="string")
     
     */
    public $barimage;
     
     
    
    /**
     * 
     * @Annotation\Type("Zend\Form\Element\Text")
     * @Annotation\Required(false)
     * @Annotation\Options({"label":"Facebook URL:"})
     * @ODM\Field(type="string")
     
     */
    
    public $facebook;
    
    /**
     * 
     * @Annotation\Type("Zend\Form\Element\Text")
     * @Annotation\Required(false)
     * @Annotation\Options({"label":"Twitter URL:"})
     * @ODM\Field(type="string")
     
     */
    
    public $twitter;
    
    /**
     * 
     * @Annotation\Type("Zend\Form\Element\Text")
     * @Annotation\Required(false)
     * @Annotation\Options({"label":"Snapchat URL:"})
     * @ODM\Field(type="string")
     
     */
    
    public $snapchat;
    
    /**
     * 
     * @Annotation\Type("Zend\Form\Element\Text")
     * @Annotation\Required(false)
     * @Annotation\Options({"label":"Instagram URL:"})
     * @ODM\Field(type="string")
     
     */
    
    public $instagram;
    
    /**
     * 
     * @Annotation\Type("Zend\Form\Element\Select")
     * @Annotation\Required(false)
     * @Annotation\Options({"label":"Affliations:",
     *                        })
     * @Annotation\Attributes({"multiple":"multiple", "class":"affiliations"})
     * @ODM\Field(type="collection")
     
     */
    
    public $affiliations;
    
    
     /**
     * @Annotation\Type("Zend\Form\Element\Select")
     * @Annotation\Required(false)
     * @Annotation\Options({"label":"Leagues:"})
     * @Annotation\Attributes({"multiple":"multiple", "class":"leagues"})
     * @ODM\Field(type="collection")
     
     */
    public $leagues;
    
     /**
     * @Annotation\Type("Zend\Form\Element\Select")
     * @Annotation\Required(false)
     * @Annotation\Options({"label":"Sports:"})
     * @Annotation\Attributes({"multiple":"multiple", "class":"sports"})
     * @ODM\Field(type="collection")
     
     */
    public $sports;
    
    /**
     * 
     * @Annotation\Type("Zend\Form\Element\checkbox")
     * @Annotation\Required(false)
     * @Annotation\Options({"label":"Featured:"})
     * @ODM\Field(type="boolean")
     
     */
    
    public $featured;

    /**
     * 
     * @Annotation\Type("Zend\Form\Element\Select")
     * @Annotation\Required(false)
     * @Annotation\Options({"label":"Vibe:",
     *                       "value_options" : {"0":"Select a Vibe","1":"Sports Bar","2":"College Bar","3":"Dive Bar","4":"Family Restaurant", "5":"Swanky Restaurant", "6": "Professional"}})
     * @ODM\Field(type="int")
     
     */
    
    
    public $vibe;
    

    
    
    /**
     * 
     * @Annotation\Type("Zend\Form\Element\Radio")
     * @Annotation\Required(false)
     * @Annotation\Options({"label":"Child Friendly:",
     *                       "value_options" : {"1":"Yes","2":"No"}})
     * @ODM\Field(type="int")
     
     */
    
    public $ageappropriate;
    
    /**
     * 
     * @Annotation\Type("Zend\Form\Element\Text")
     * @Annotation\Required(false)
     * @Annotation\Options({"label":"# Televisions:"})
     * @ODM\Field(type="string")
     
     */
    
    public $televisions;
    
    /**
     * 
     * @Annotation\Type("Zend\Form\Element\Select")
     * @Annotation\Required(false)
     * @Annotation\Options({"label":"Outdoor Seating",
     *                       "value_options" : {"0":"Outdoor Seating","1":"Yes w-TVs","2":"Yes no-TV","3":"No"}})
     * @ODM\Field(type="int")
     
     */
    
    public $outdoorseating;
    
    /**
     * 
     * @Annotation\Type("Zend\Form\Element\Text")
     * @Annotation\Required(false)
     * @Annotation\Options({"label":"Capacity:"})
     * @ODM\Field(type="int")
     
     */
    
    public $capacity;
    
    /**
     * @Annotation\Type("Zend\Form\Element\Select")
     * @Annotation\Required(false)
     * @Annotation\Options({"label":"Type",
     *                       "value_options" : {"0":"Type","1":"National","2":"Regional","3":"City","4":"Single Location"}})
     * @ODM\Field(type="int")
     
     */
    
    public $type;
    
     /**
     * 
     * @Annotation\Type("Zend\Form\Element\Textarea")
     * @Annotation\Required(false)
     * @Annotation\Options({"label":"Staples:"})
     * @Annotation\Attributes({"class":"ckeditor"})
     * @ODM\Field(type="string")
     
     */
    
    public $staples;
    
    /**
     * 
     * @Annotation\Type("Zend\Form\Element\Textarea")
     * @Annotation\Required(false)
     * @Annotation\Options({"label":"Menu:"})
     * @Annotation\Attributes({"class":"ckeditor"})
     * @ODM\Field(type="string")
     
     */
    
    public $menu;
    
    /**
     * @Annotation\Type("Zend\Form\Element\Select")
     * @Annotation\Required(false)
     * @Annotation\Options({"label":"Food Prices",
     *                       "value_options" : {"0":"Prices","1":"$0-12","2":"$12-20","3":"$20-30","4":"$30+"}})
     * @ODM\Field(type="int")
     
     */
    
    public $foodprices;
    
    /**
     * @Annotation\Type("Zend\Form\Element\Radio")
     * @Annotation\Required(false)
     * @Annotation\Options({"label":"Happy Hour:",
     *                      "value_options" : {"1":"Yes","2":"No"}})
     *  @ODM\Field(type="int")
     */
    
    public $happyhour;
    
    /**
     * 
     * @Annotation\Type("Zend\Form\Element\Text")
     * @Annotation\Required(false)
     * @Annotation\Options({"label":"Happy Hour Time:"})
     * @ODM\Field(type="string")
     
     */
    
    public $hhtime;
    
    /**
     * @Annotation\Type("Zend\Form\Element\Select")
     * @Annotation\Required(false)
     * @Annotation\Options({"label":"Full Bar",
     *                       "value_options" : {"1":"Full Bar","2":"Beer & Wine","3":"No Alcohol"}})
     * @ODM\Field(type="int")
     
     */
    
    public $fullbar;
    
    
    /**
     * 
     * @Annotation\Type("Zend\Form\Element\Textarea")
     * @Annotation\Required(false)
     * @Annotation\Options({"label":"Drink Specials"})
     * @Annotation\Attributes({"class":"ckeditor"})
     * @ODM\Field(type="string") 
     */
    
    public $drinkspecials;
    
    /**
     * 
     * @Annotation\Type("Zend\Form\Element\Text")
     * @Annotation\Required(false)
     * @Annotation\Options({"label":"# of Bars"})
     * @ODM\Field(type="int")
     
     */
    
    public $barnumber;
    
     /**
     * @Annotation\Type("Zend\Form\Element\Select")
     * @Annotation\Required(false)
     * @Annotation\Options({"label":"Public Transportation",
     *                       "value_options" : {"1":"Train","2":"Bus","3":"None"}})
     * @ODM\Field(type="int")
     
     */
    
    public $publictrans;
    
    /**
     * 
     * @Annotation\Type("Zend\Form\Element\Text")
     * @Annotation\Required(false)
     * @Annotation\Options({"label":"Train Station"})
     * @ODM\Field(type="string")
     
     */
    
    public $trainstation;
    
    /**
     * @Annotation\Type("Zend\Form\Element\Radio")
     * @Annotation\Required(false)
     * @Annotation\Options({"label":"Parking:",
     *                      "value_options" : {"1":"Yes","2":"No"}})
     *  @ODM\Field(type="int")
     */
    
    public $parking;
    
    /**
     * @Annotation\Type("Zend\Form\Element\Select")
     * @Annotation\Required(false)
     * @Annotation\Options({"label":"Parking Type",
     *                       "value_options" : {"0":"Parking Type","1":"On Property","2":"Nearby Public","3":"Street"}})
     * @ODM\Field(type="int")
     
     */
    
    public $parkingtype;
    
    /**
     * @Annotation\Type("Zend\Form\Element\Textarea")
     * @Annotation\Required(false)
     * @Annotation\Options({"label":"TV Specials",})
     * @Annotation\Attributes({"class":"ckeditor"})                       
     * @ODM\Field(type="string")
     
     */
    
    public $tvspecials;
    
     /**
     * @Annotation\Type("Zend\Form\Element\Radio")
     * @Annotation\Required(false)
     * @Annotation\Options({"label":"TV Change Flexible:",
     *                      "value_options" : {"1":"Yes","2":"No"}})
     *  @ODM\Field(type="int")
     */
    public $tvchange;
    
     /**
     * @Annotation\Type("Zend\Form\Element\Text")
     * @Annotation\Required(false)
     * @Annotation\Options({"label":"Live Music:",})
     *  @ODM\Field(type="string")
     */
    
    public $music;
    
    /**
     * @Annotation\Type("Zend\Form\Element\Text")
     * @Annotation\Required(false)
     * @Annotation\Options({"label":"DJ:",})
     *  @ODM\Field(type="string")
     */
    
    public $dj;
    
    /**
     * @Annotation\Type("Zend\Form\Element\Text")
     * @Annotation\Required(false)
     * @Annotation\Options({"label":"Sister/Brother Restaurant (Ownership):",})
     *  @ODM\Field(type="string")
     */
    
    public $otherbar;
    
    /**
     * @Annotation\Type("Zend\Form\Element\Radio")
     * @Annotation\Required(false)
     * @Annotation\Options({"label":"Dress Code:",
     *                       "value_options" : {"1":"Yes","2":"No"}})
     *  @ODM\Field(type="int")
     */
    
    public $dresscode;
    
    /**
     * 
     * @Annotation\Type("Zend\Form\Element\Textarea")
     * @Annotation\Required(false)
     * @Annotation\Options({"label":"Special notes"})
     * @Annotation\Attributes({"class":"ckeditor"})
     * @ODM\Field(type="string")
     
     */
    
    public $notes;
    
    /**
     *  @Annotation\Exclude()
     *  @ODM\Field(type="float")
     */
    
    
    public $latitude;
    
    /**
     *  @Annotation\Exclude()
     *  @ODM\Field(type="float")
     */
    
    
    public $longitude;
    
    /**
     *  @Annotation\Exclude()
     *  @ODM\EmbedOne(targetDocument="GoogleMapsTools\Point") 
     */
    
    public $point;
    
    
     /**
     * @Annotation\Type("Zend\Form\Element\Submit")
     * @Annotation\Attributes({"value":"Submit"})
     * 
     */
     
     public $submit;
        
    // Functions Begin
    
    //Setters and Getters
     public function getId() {return $this->id;}
     
     public function getName() {return $this->name; }
     public function setName($name) { $this->name = $name; }
     
     public function getBardescription() { return $this->bardescription; }
     public function setBardescription($bardescription) { $this->bardescription = $bardescription; } 
     
     public function getLocation() { return $this->location; }
     public function setLocation($location) {$this->location = $location; }
     
     public function getBarimage() { return $this->barimage; }
     public function setBarimage($barimage) {$this->barimage = $barimage; }
     
     public function getHours() { return $this->hours; }
     public function setHours($hours) { $this->hours = $hours; }
     
     public function getPhone() {return $this->phone; }
     public function setPhone($phone) { $this->phone = $phone; }
     
     public function getWebsite() {return $this->website; }
     public function setWebsite($website) { $this->website = $website; }
     
     public function getFacebook() {return $this->facebook; }
     public function setFacebook($facebook) { $this->facebook = $facebook; }
     
     public function getTwitter() {return $this->twitter; }
     public function setTwitter($twitter) { $this->twitter = $twitter; }
     
     public function getInstagram() {return $this->instagram; }
     public function setInstagram($instagram) { $this->instagram = $instagram; }
     
     public function getSnapchat() {return $this->snapchat; }
     public function setSnapchat($snapchat) { $this->snapchat = $snapchat; }
     
     public function getAffiliations() {return $this->affiliations; }
     public function getAffiliationsview(){
       $aff1 = $this->affiliations;
       foreach($aff1 as $aff2){
        $name = $aff2->getTeamname();
        
        return $name;
       }
     }
     public function setAffiliations($affiliations) { $this->affiliations = $affiliations; }
     
     
    public function getLeagues() { return $this->leagues;}
    public function getLeaguesview(){
       $league0 = $this->leagues;
        foreach ($league0 as $league1) {
            switch($league1) {
            case '0':
               $league2 = 'MLB';
			break;
            case '1':
				$league2 = 'MLS';
			break;
            case '2':
				$league2 = 'Euro Cup';
			break;
            }
            
            return $league2 ;
        }
        
    }
     public function setLeagues($leagues) { $this->leagues = $leagues; }
     
     public function getSports() {return $this->sports; }
       public function getSportsview(){
       $sport0 = $this->sports;
        foreach ($sport0  as $sport1) {
            switch($sport1) {
            case '0':
               $sport2 = 'Baseball';
			break;
            case '1':
				$sport2 = 'Soccer';
			break;
            }
            
            return $sport2;
        }
        
    }
     public function setSports($sports) { $this->sports = $sports; }
     
     public function getFeatured() {return $this->featured;}
     public function setFeatured($featured) { $this->featured = $featured; }
     
     public function getVibe() {return $this->vibe; }
     public function getVibeview(){
        switch($this->vibe) {
            case '1':
               $vibe1 = 'Sports Bar';
			break;
            case '2':
				$vibe1 = 'College Bar';
			break;
            case '3':
				$vibe1 = 'Dive Bar';
			break;
            case '4':
				$vibe1 = 'Family Restaurant';
			break;
            case '5':
				$vibe1 = 'Swanky Restaurant';
			break;
            case '6':
				$vibe1 = 'Professional';
			break;
            }
            
            return $vibe1;

     }
     public function setVibe($vibe) { $this->vibe = $vibe; }
     
     public function getAgeappropriate() {return $this->ageappropriate; }
     public function getAgeappropritateview() {
            switch($this->ageappropriate) {
            case '1':
               $ageappropriate1 = 'Yes';
			break;
            case '2':
				$ageappropriate1 = 'No';
			break;
            }
            
            return $ageappropriate1;

     }
     public function setAgeappropriate($ageappropriate) { $this->ageappropriate = $ageappropriate; }
     
     public function getTelevisions() {return $this->televisions; }
     public function setTelevisions($televisions) { $this->televisions = $televisions; }

     public function getOutdoorseating() {return $this->outdoorseating; }
     public function getOutdoorseatingview() {
            switch($this->outdoorseating) {
            case '1':
               $ageappropriate1 = 'Yes w-TVs';
			break;
            case '2':
				$outdoorseating1 = 'Yes no-TV';
			break;
            case '3':
				$outdoorseating1 = 'No';
			break;
            }
            
            return $outdoorseating1;
     }
     public function setOutdoorseating($outdoorseating) { $this->outdoorseating = $outdoorseating; }
     
     public function getCapacity() {return $this->capacity; }
     public function setCapacity($capacity) { $this->capacity = $capacity; }
     
     public function getType() { $this->type;}
     public function getTypeview() {
        switch($this->type) {
            case '1':
				$type1 = 'National';
			break;
            case '2':
				$type1 = 'Regional';
			break;
            case '3':
				$type1 = 'City';
			break;
            case '4':
				$type1 = 'Single Location';
			break;
        }
         return $type1;
     }
     public function setType($type) { $this->type = $type; }
     
     public function getStaples() {return $this->staples; }
     public function setStaples($staples) { $this->staples = $staples; }
     
     public function getMenu() {return $this->menu; }
     public function setMenu($menu) { $this->menu = $menu; }
     
     public function getFoodprices() {return $this->foodprices; }
     public function getFoodpricesview() {
            switch($this->foodprices) {
            case '1':
               $foodprices1 = '$0-12';
			break;
            case '2':
				$foodprices1 = '$12-20';
			break;
            case '3':
				$foodprices1 = '$20-30';
			break;
            case '4':
				$foodprices1 = '$30+';
			break;
            }
            
            return $foodprices1;
     }
     public function setFoodprices($foodprices) { $this->foodprices = $foodprices; }
     
     public function getHappyhour() {return $this->happyhour; }
     public function getHappyhourview() {
        
            switch($this->happyhour) {
            case '1':
               $happyhour1 = 'Yes';
			break;
            case '2':
				$happyhour1 = 'No';
			break;
            }
            
            return $happyhour1;
     }
     public function setHappyhour($happyhour) { $this->happyhour = $happyhour; }
     
     public function getHhtime() {return $this->hhtime; }
     public function setHhtime($hhtime) { $this->hhtime = $hhtime; }
     
     public function getFullbar() {return $this->fullbar; }
     public function getFullbarview() {
            switch($this->fullbar) {
            case '1':
               $fullbar1 = 'Full Bar';
			break;
            case '2':
				$fullbar1 = 'Beer & Wine';
			break;
            case '3':
				$fullbar1 = 'No Alcohol';
			break;
            }
            
            return $fullbar1;
     }
     public function setFullbar($fullbar) { $this->fullbar = $fullbar; }
     
     public function getDrinkspecials() {return $this->drinkspecials; }
     public function setDrinkspecials($drinkspecials) { $this->drinkspecials = $drinkspecials; }
     
     public function getBarnumber() {return $this->barnumber; }
     public function setBarnumber($barnumber) { $this->barnumber = $barnumber; }
     
     public function getPublictrans() {return $this->publictrans; }
     public function getPublictransview() {
        
            switch($this->publictrans) {
            case '1':
               $publictrans1 = 'Train';
			break;
            case '2':
				$publictrans1 = 'Bus';
			break;
            case '3':
				$publictrans1 = 'None';
			break;
            }
            
            return $publictrans1;
        }
        
     public function setPublictrans($publictrans) { $this->publictrans = $publictrans; }
     
     public function getTrainstation() {return $this->trainstation; }
     public function setTrainstation($trainstation) { $this->trainstation = $trainstation; }
     
     
     public function getParking() {return $this->parking; }
     public function getParkingview() {
            switch($this->parking) {
            case '1':
               $parking1 = 'Yes';
			break;
            case '2':
				$parking1 = 'No';
			break;
            }
            
            return $parking1;
        
     }
     public function setParking($parking) { $this->parking = $parking; }
     
     
     public function getParkingtype() {return $this->parkingtype; }
     public function getParkingtypeview() {
    
            switch($this->parkingtype) {
            case '1':
               $parkingtype1 = 'On Property';
			break;
            case '2':
				$parkingtype1 = 'Nearby Public';
			break;
            case '3':
				$parkingtype1 = 'Street';
			break;
            }
            
            return $parkingtype1;
        }
    
     public function setParkingtype($parkingtype) { $this->parkingtype = $parkingtype; }
     
     public function getTvspecials() {return $this->tvspecials; }
     public function setTvspecials($tvspecials) { $this->tvspecials = $tvspecials; }
     
     public function getTvchange() {return $this->tvchange; }
     public function getTvchangeview() {
         
            switch($this->tvchange) {
            case '1':
               $tvchange1 = 'Yes';
			break;
            case '2':
				$tvchange1 = 'No';
			break;
            }
            
            return $tvchange1;
        }
        
     public function setTvchange($tvchange) { $this->tvchange = $tvchange; }
     
     public function getMusic() {return $this->music; }
     public function setMusic($music) { $this->music = $music; }
     
     public function getDj() {return $this->dj; }
     public function setDj($dj) { $this->dj = $dj; }
     
     public function getOtherbar() {return $this->otherbar; }
     public function setOtherbar($otherbar) { $this->otherbar = $otherbar; }
     
     public function getDresscode() {return $this->dresscode; }
     public function getDresscodeview() {
            switch($this->dresscode) {
            case '1':
               $dresscode1 = 'Yes';
			break;
            case '2':
				$dresscode1 = 'No';
			break;
            }
            
            return $dresscode1;
        }
        
     public function setDresscode($dresscode) { $this->dresscode = $dresscode; }
     
     public function getLatitude1() {return $this->latitude; }
     public function setLatitude1($latitude) { $this->latitude = $latitude; }
     
     public function getLongitude1() {return $this->longitude; }
     public function setLongitude1($longitude) { $this->longitude = $longitude; }

     public function getPoint() {return $this->point; }
     public function setPoint($point) { $this->point = $point; }
     
     public function getNotes() {return $this->notes;}
     public function setNotes($notes) {$this->notes = $notes;}
     
     public function setInputFilter(InputFilterInterface $inputFilter)
    {
        throw new \Exception("Not used");
    }
     
    public function getInputFilter()
    {
        if (!$this->inputFilter) {
            $inputFilter = new InputFilter();
            $factory  = new InputFactory();
              
             
            $inputFilter->add(
                $factory->createInput(array(
                    'name' => 'barimage',
                    'required' => true,
                ))
            );
            
            $inputFilter->add(
                $factory->createInput(array(
                    'name' => 'bardescription',
                    'required' => true,
                ))
            );
             
            $this->inputFilter = $inputFilter;
        }
         
        return $this->inputFilter;
    }
     
}