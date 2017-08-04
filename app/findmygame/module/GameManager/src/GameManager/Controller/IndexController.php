<?php

namespace GameManager\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Form\Annotation\AnnotationBuilder;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineObjectHydrator;
use Zend\Form\Element;
use Doctrine\ODM\MongoDB\Mapping\Driver\AnnotationDriver;
use DoctrineODMModule\Stdlib\Hydrator\DoctrineEntity;
use DoctrineODMModule\Form\Annotation\AnnotationBuilder as DoctrineAnnotationBuilder;
use GoogleMapsTools\Api\Geocode;
use GoogleMapsTools\Api\Distancematrix;
use GameManager\Models\Bar;
use GameManager\Models\Team;
use GameManager\Models\Image;
use GameManager\Queries\BarQuery;
use GameManager\Tables\BarTable;
use Zend\Paginator;
use Zend\Validator\File\Size;
use Zend\Http\PhpEnvironment\Request;
use GameManager\Controller\Services\AffiliationsRetrieve;

class IndexController extends AbstractActionController
{
	
    
    /**
     * Property to hold Doctrine Entity Manager
     *
     * @var object
     */
    protected $_em = null;
	
    /**
     * Retrieve action from CRUD
     *
     * The method uses Doctrine Entity Manager to retrieve the Entities from the virtual database
     *
     * @return Zend\View\Model\ViewModel|array colection of objects
     */
    
    public function indexAction()
    {
        
		$this->layout('games');
	 
		$dm = $this->getServiceLocator()->get('doctrine.documentmanager.odm_default');

		$affiliations = new AffiliationsRetrieve();
		$affarray = $affiliations->retrieveAff($dm);
		
		$newaff = $affarray[0];
		$leagues = $affarray[1];
		$sports = $affarray[2];
	
         return new ViewModel(array('affs' => $newaff, 'leagues' => $leagues, 'sports' => $sports ));
    }

   	
	public function searchAction()
    {
	 
	 $this->layout('search');
	   //$this->layout('result-partial');
	 
	   global $repository;
	   global $data;

		$dm = $this->getServiceLocator()->get('doctrine.documentmanager.odm_default');
		$repository = $dm->getRepository('GameManager\Models\Bar');
		$affs = $dm->getRepository('GameManager\Models\Team')->findAll();
		
		$query1 = new BarQuery;
	
		$array = $query1->barsearch();
		$paginator = new \Zend\Paginator\Paginator(new \Zend\Paginator\Adapter\ArrayAdapter($array));        	
		$paginator->setCurrentPageNumber($this->params()->fromRoute('page'));
		
	    $this->layout()->setVariables(array('affs' => $affs,));
        
		return new ViewModel(array('bars' => $data));
	}
	
	public function viewindiAction() {
	 
	 $this->layout('viewindi');
	 
	  $id = $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('findmygame', array(
                'action' => 'index'
            ));
        }
		
		$dm = $this->getServiceLocator()->get('doctrine.documentmanager.odm_default');
        $repository = $dm->getRepository('GameManager\Models\Bar');
		$bar = $repository->find($id);
		$repository2 = $dm->getRepository('GameManager\Models\Team');
		$affs = $bar->getAffiliations();
		$affiliations = array();
		foreach ($affs as $aff) {
		 $affiliations[] = $repository2->find($aff);
		}
		
		return new ViewModel(array('bar' => $bar, 'affiliations' => $affiliations));
	 
	}

	

}

