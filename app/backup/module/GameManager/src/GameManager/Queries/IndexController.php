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
Use GameManager\Queries\BarQuery;
use GameManager\Tables\BarTable;
use Zend\Paginator;


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

		//Add Affiliations
		$affs = $dm->getRepository('GameManager\Models\Team')->findAll();

         return new ViewModel(array('affs' => $affs));
    }

    public function deleteAction()
    {
		
		$id = $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('findmygame', array(
                'action' => 'manage'
            ));
        }
		
		 $dm = $this->getServiceLocator()->get('doctrine.documentmanager.odm_default');
		
		$repository = $dm->getRepository('GameManager\Models\Bar');
		$bar = $repository->find($id);
		
		 $request = $this->getRequest();
        if ($request->isPost()) {
            $del = $request->getPost('del', 'No');
            if ($del == 'Yes') {
                $id = $request->getPost('id');
				
				$bar = $repository->find($id);
				$dm->remove($bar);
				$dm->flush();
            }
            // Redirect to list of albums
           return $this->redirect()->toRoute('findmygame/default',  array('controller' => 'Index', 'action' => 'view'));
        }
        return array(
            'id'    => $id,
            'bar' => $bar,
        );	
		
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
   
    public function editAction() {
        
        $id = $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('findmygame', array(
                'action' => 'manage'
            ));
        }
        // Get the Bar with the specified id.  An exception is thrown
        // if it cannot be found, in which case go to the index page.
		
        $dm = $this->getServiceLocator()->get('doctrine.documentmanager.odm_default');
        

            $repository = $dm->getRepository('GameManager\Models\Bar');
			$bar = $repository->find($id);
            //$bars = array($bar->getBarid(), $bar->getDetails(), $bar->getName());
    
		
        $builder = new AnnotationBuilder($dm);
        $form = $builder->createForm($bar);
		//Add Affiliations
		$affs = $dm->getRepository('GameManager\Models\Team')->findAll();
		$affsOptions = [null => ''];
		foreach ($affs as $aff) {
			$affOptions[$aff->getTeamid()] = $aff->getTeamname();
		}
		
		//End add Affiliations
        $form->setHydrator(new DoctrineObjectHydrator($dm, 'GameManager\Models\Bar'));
        $form->get('affiliations')->setValueOptions($affOptions);
		
		$form->bind($bar);
       
		$request = $this->getRequest();
        if ($request->isPost()){
			//Getting offical location with Google Maps
		$address = $_POST['location'];
		$geocode = new Geocode($address);
		$geocode->execute();
		$point = $geocode->getFirstPoint();
		
//Setting Latitude and Longitude in database
		
		$latitude = $point->getLatitude();
		$longitude = $point->getLongitude();
		$bar->setLatitude1($latitude);
		$bar->setLongitude1($longitude);
		$bar->setPoint($point);
            $form->bind($bar);
            $form->setData($request->getPost());
            if ($form->isValid()){
               $dm->persist($bar);
               $dm->flush();
            }
            
            return $this->redirect()->toRoute('findmygame/default',  array('controller' => 'Index', 'action' => 'view'));
        }
        
         return array(
            'id' => $id,
            'form' => $form,
        );
        
    }
	

    public function viewAction()
    {
        $dm = $this->getServiceLocator()->get('doctrine.documentmanager.odm_default');
        
        $qb = $dm->createQueryBuilder('GameManager\Models\Bar')->sort('name', 'asc');
        $query = $qb->getQuery();
        $bars = $query->execute();
		
		return new ViewModel(array('bars' => $bars));
    }

    public function searchAction()
    {
	 
	   $this->layout('result-partial');
	 
	   global $repository;
	   global $data;

		$dm = $this->getServiceLocator()->get('doctrine.documentmanager.odm_default');
		$repository = $dm->getRepository('GameManager\Models\Bar');
		
		$query1 = new BarQuery;
	
		$array = $query1->barsearch();
		$paginator = new \Zend\Paginator\Paginator(new \Zend\Paginator\Adapter\ArrayAdapter($array));        	
		$paginator->setCurrentPageNumber($this->params()->fromRoute('page'));
		
	    $this->layout()->setVariables(array('bars' => $data,));
        
		return false;
	}

	public function manageAction()
    {
        
        $dm = $this->getServiceLocator()->get('doctrine.documentmanager.odm_default');
        
        $bar = new Bar();
        $builder = new AnnotationBuilder($dm);
	    $form = $builder->createForm($bar);
		
		//Add Affiliations
		$affs = $dm->getRepository('GameManager\Models\Team')->findAll();
		$affsOptions = [null => ''];
		foreach ($affs as $aff) {
			$affOptions[$aff->getTeamid()] = $aff->getTeamname();
		}
		//End add Affiliations
        $form->setHydrator(new DoctrineObjectHydrator($dm, 'GameManager\Models\Bar'));
        $form->get('affiliations')->setValueOptions($affOptions);
		 
        $request = $this->getRequest();
		
        if ($request->isPost()){
			
			//Getting offical location with Google Maps
		$address = $_POST['location'];
		$geocode = new Geocode($address);
		$geocode->execute();
		$point = $geocode->getFirstPoint();
		
//Setting Latitude and Longitude in database
		
		$latitude = $point->getLatitude();
		$longitude = $point->getLongitude();
		$bar->setLatitude1($latitude);
		$bar->setLongitude1($longitude);
		$bar->setPoint($point);
            $form->bind($bar);
            $form->setData($request->getPost());
            if ($form->isValid()){
               $dm->persist($bar);
               $dm->flush();
            }
            
             return $this->redirect()->toRoute('findmygame/default',  array('controller' => 'Index', 'action' => 'view'));
        }
         
        return array('form'=>$form);
    }
	
	public function addteamAction()
    {
        
        $dm = $this->getServiceLocator()->get('doctrine.documentmanager.odm_default');
        
        $team = new Team();
        $builder = new AnnotationBuilder($dm);
        $form = $builder->createForm($team);
        $form->setHydrator(new DoctrineObjectHydrator($dm, 'GameManager\Models\Team'));
         
        $request = $this->getRequest();
        if ($request->isPost()){
            $form->bind($team);
            $form->setData($request->getPost());
            if ($form->isValid()){
               $dm->persist($team);
               $dm->flush();
            }
            
             return $this->redirect()->toRoute('findmygame/default',  array('controller' => 'Index', 'action' => 'view'));
        }
         
        return array('form'=>$form);
    }


}

