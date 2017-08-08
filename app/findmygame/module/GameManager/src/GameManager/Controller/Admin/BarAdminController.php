<?php

namespace GameManager\Controller\Admin;

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

class BarAdminController extends AbstractActionController {
	
     public function deleteAction()
    {
	   
	   // Redirect if user isn't logged in
	   
	   if (!$this->zfcUserAuthentication()->hasIdentity()) {
		return $this->redirect()->toRoute('zfcuser/login');
	   }
	   
		
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
           return $this->redirect()->toRoute('findmygame/default',  array('controller' => 'BarAdmin', 'action' => 'view'));
        }
        return array(
            'id'    => $id,
            'bar' => $bar,
        );	
		
    }
	
   
    
    public function editAction()
    
    {
	   // Redirect if user isn't logged in
	   
	    if (!$this->zfcUserAuthentication()->hasIdentity()) {
		return $this->redirect()->toRoute('zfcuser/login');
	   }
	    
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
		$builder = new AnnotationBuilder($dm);
		$form = $builder->createForm($bar);
		$form->setAttribute('enctype','multipart/form-data');
		
		/*Add Affiliations, Sports, Leagues to form
		 * Utilizes AffiliationsRetrieve() from GameManager/Services/Affiliations
		 */
		
		$affiliations = new AffiliationsRetrieve();
		$affarray = $affiliations->retrieveAff($dm);
		
		
		$form->setHydrator(new DoctrineObjectHydrator($dm, 'GameManager\Models\Bar'));
		$form->get('affiliations')->setValueOptions($affarray[0]);
		$form->get('sports')->setValueOptions($affarray[2]);
		$form->get('leagues')->setValueOptions($affarray[1]);
		
		$form->bind($bar);
       
		$request = $this->getRequest();
        if ($request->isPost()){
		 //Handling Image Upload
        $File = $this->params()->fromFiles('barimage');
        $data1 =  $File['tmp_name']. '_' .$File['name']; //FILE...
		$data2 = substr($data1, 5);
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
		if ($data2 == "") {
		} else {
		 $bar->setBarimage($data2);
		}
        $form->bind($bar);
        $form->setData($request->getPost());

			if ($form->isValid()){
			   $size = new Size(array('min'=>20));
			   $adapter = new \Zend\File\Transfer\Adapter\Http(); 
			   $adapter->setValidators(array($size), $File);

                if (!$adapter->isValid()){
                    $dataError = $adapter->getMessages();
                    $error = array();
                    foreach($dataError as $key=>$row)
                    {
                        $error[] = $row;
                    }
				   
                    $form->setMessages(array('barimage'=>$error ));
                } else {
                    $adapter->setDestination(dirname(__DIR__).'/Assets');
                    if ($adapter->receive($File['filename'])) {		   
						echo "Success!";
                }
			  }
			
			   $dm->persist($bar);
               $dm->flush();
            }
            
           return $this->redirect()->toRoute('findmygame/default',  array('controller' => 'BarAdmin', 'action' => 'view'));
        }
        
         return array(
            'id' => $id,
            'form' => $form,
        );
        
    }
	
   
	

    public function viewAction()
    {
	
	// Redirect if user isn't logged in
	
        if (!$this->zfcUserAuthentication()->hasIdentity()) {
		return $this->redirect()->toRoute('zfcuser/login');
	   }
	   else {
	   
	   
	   $dm = $this->getServiceLocator()->get('doctrine.documentmanager.odm_default');
        
        $bars = $dm->getRepository('GameManager\Models\Bar')->findBy(array(), 
                 array('name' => 'ASC'));

	 return new ViewModel(array('bars' => $bars));
	   }
    }
    
    public function manageAction()
    {
	
	// Redirect if user isn't logged in
	
	if (!$this->zfcUserAuthentication()->hasIdentity()) {
		return $this->redirect()->toRoute('zfcuser/login');
	   }
        
		$dm = $this->getServiceLocator()->get('doctrine.documentmanager.odm_default');
        
		$bar = new Bar();
		$builder = new AnnotationBuilder($dm);
		$form = $builder->createForm($bar);
		$form->setAttribute('enctype','multipart/form-data');
		
		/*Add Affiliations, Sports, Leagues to form
		 * Utilizes AffiliationsRetrieve() from GameManager/Services/Affiliations
		 */
		
		$affiliations = new AffiliationsRetrieve();
		$affarray = $affiliations->retrieveAff($dm);
		
		$form->setHydrator(new DoctrineObjectHydrator($dm, 'GameManager\Models\Bar'));
		$form->get('affiliations')->setValueOptions($affarray[0]);
		$form->get('sports')->setValueOptions($affarray[2]);
		$form->get('leagues')->setValueOptions($affarray[1]);
		 
		$request = $this->getRequest();
		
        if ($request->isPost()){
		 //Handling image upload
		$File = $this->params()->fromFiles('barimage');
		$data1 =  $File['tmp_name']. '_' .$File['name']; //FILE...
		$data2 = substr($data1, 5);
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
		if ($data2 == "") {
		} else {
		 $bar->setBarimage($data2);
		}
          $form->bind($bar);
          $form->setData($request->getPost());
            if ($form->isValid()){
			   $size = new Size(array('min'=>20));
			   $adapter = new \Zend\File\Transfer\Adapter\Http(); 
			   $adapter->setValidators(array($size), $File);

                if (!$adapter->isValid()){
                    $dataError = $adapter->getMessages();
                    $error = array();
                    foreach($dataError as $key=>$row)
                    {
                        $error[] = $row;
                    }
				   
                    $form->setMessages(array('barimage'=>$error ));
                } else {
                    $adapter->setDestination(dirname(__DIR__).'/Assets');
                    if ($adapter->receive($File['filename'])) {		   
						echo "Success!";
                }
			  }
               $dm->persist($bar);
               $dm->flush();
            }
            
             return $this->redirect()->toRoute('findmygame/default',  array('controller' => 'Index', 'action' => 'view'));
        }
         
        return array('form'=>$form);
    }

}