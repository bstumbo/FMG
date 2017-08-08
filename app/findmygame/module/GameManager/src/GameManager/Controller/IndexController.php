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
use Zend\Validator\File\Size;
use Zend\Http\PhpEnvironment\Request;
use GameManager\Controller\Services\AffiliationsRetrieve;
use Zend\Paginator\Adapter;
use Zend\Paginator\Paginator;
use Zend\Paginator\Adapter\ArrayAdapter;



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
		
		$affiliations = new AffiliationsRetrieve();
		$affarray = $affiliations->retrieveAff($dm);
		
		$newaff = $affarray[0];
		$leagues = $affarray[1];
		$sports = $affarray[2];
		
		$query1 = new BarQuery;
	
		$array = $query1->barsearch();
	
	    $this->layout()->setVariables(array('newaff' => $newaff, 'leagues' => $leagues, 'sports' => $sports));
		
		
        
		$barsarray = array('bars' => $data);
		$paginator = new Paginator(new ArrayAdapter($array));
		$page = $this->params()->fromRoute('page', 1);
		$paginator->setCurrentPageNumber($page);
		$paginator->setItemCountPerPage(5);
		
		$vm = new ViewModel(array('bars' => $data));
		$vm->setVariable('paginator', $paginator);
		return $vm;
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
		
		$affiliations_search = new AffiliationsRetrieve();
		$affarray = $affiliations_search->retrieveAff($dm);
		
		$newaff = $affarray[0];
		$leagues = $affarray[1];
		$sports = $affarray[2];
		
		$bar = $repository->find($id);
		$repository2 = $dm->getRepository('GameManager\Models\Team');
		$affs = $bar->getAffiliations();
		$affiliations = array();
		foreach ($affs as $aff) {
		 $affiliations[] = $repository2->find($aff);
		 
		}
		
		$this->layout()->setVariables(array('newaff' => $newaff, 'leagues' => $leagues, 'sports' => $sports));
		
		return new ViewModel(array('bar' => $bar, 'affiliations' => $affiliations));
	 
	}

	

}

