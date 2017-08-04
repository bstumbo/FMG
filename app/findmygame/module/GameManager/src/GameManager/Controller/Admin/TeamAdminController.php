<?php

namespace GameManager\Controller\Admin;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\File\Transfer\Adapter\Http;
use Zend\View\Model\ViewModel;
use Zend\Form\Annotation\AnnotationBuilder;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineObjectHydrator;
use Zend\Form\Element;
use Zend\Form;
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
use DoctrineModule\Validator\NoObjectExists;
use GameManager\Controller\Services\AffiliationsRetrieve;

class TeamAdminController extends AbstractActionController {

public function viewAction()
    {
	
	// Redirect if user isn't logged in
	
        if (!$this->zfcUserAuthentication()->hasIdentity()) {
		return $this->redirect()->toRoute('zfcuser/login');
	   }
	   else {
	   
	   
	   $dm = $this->getServiceLocator()->get('doctrine.documentmanager.odm_default');
        
        $teams = $dm->getRepository('GameManager\Models\Team')->findBy(array(), 
                 array('teamname' => 'ASC', 'league' => 'ASC'));
        //$query = $qb->getQuery();
        //$bars = $query->execute();
		
	 return new ViewModel(array('teams' => $teams));
	   }
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
        // Get the Team with the specified id.  An exception is thrown
        // if it cannot be found, in which case go to the index page.
		
        $dm = $this->getServiceLocator()->get('doctrine.documentmanager.odm_default');
		$repository = $dm->getRepository('GameManager\Models\Team');
		$team = $repository->find($id);
        $builder = new AnnotationBuilder($dm);
		
		/*
		 * Get all sports and leagues for form selection
		 * Utilizes AffiliationsRetrieve() in GameManager/Services/Affiliations
		 */
		
		$affiliations = new AffiliationsRetrieve();
		$affarray = $affiliations->retrieveAff($dm);
		
		
        $form = $builder->createForm($team);
		$form->setAttribute('enctype','multipart/form-data');
        $form->setHydrator(new DoctrineObjectHydrator($dm, 'GameManager\Models\Team'));
		$form->get('sport')->setValueOptions($affarray[2]);
		$form->get('league')->setValueOptions($affarray[1]);
		$form->bind($team);
       
		$request = $this->getRequest();
        
		if ($request->isPost()){
		
			$form->bind($team);
			$form->setData($request->getPost());
			if ($form->isValid()){
               $dm->persist($team);
               $dm->flush();
            }
            
			return $this->redirect()->toRoute('findmygame/default',  array('controller' => 'TeamAdmin', 'action' => 'view'));
			}
            
         return array(
            'id' => $id,
            'form' => $form,
        );
        
	}

public function addteamAction()
    {
        
        $dm = $this->getServiceLocator()->get('doctrine.documentmanager.odm_default');
        
        $team = new Team();
        $builder = new AnnotationBuilder($dm);
        $form = $builder->createForm($team);
		
		/*
		 * Get all sports and leagues for form selection
		 * Utilizes AffiliationsRetrieve() in GameManager/Services/Affiliations
		 */
		
		$affiliations = new AffiliationsRetrieve();
		$affarray = $affiliations->retrieveAff($dm);
		
        $form->setHydrator(new DoctrineObjectHydrator($dm, 'GameManager\Models\Team'));
		$form->get('sport')->setValueOptions($affarray[2]);
		$form->get('league')->setValueOptions($affarray[1]);
         
        $request = $this->getRequest();
		
        if ($request->isPost()){
			
			$validator = new NoObjectExists(
				array('object_manager' => $dm,
					  'object_repository' => $dm->getRepository('GameManager\Models\Team'),
					  'fields' => ['teamname'])
				);
			
            $form->bind($team);
            $form->setData($request->getPost());
            if ($form->isValid() && $validator->isValid($team->teamname)){
               $dm->persist($team);
               $dm->flush();
            } else {
				$messages = $validator->getMessages();
				 echo implode("\n", $messages);	
			}
            
             return $this->redirect()->toRoute('findmygame/default',  array('controller' => 'TeamAdmin', 'action' => 'view'));
        }
         
        return array('form'=>$form);
    }
	


public function bulkuploadAction() {
	return new ViewModel();
}




public function bulkuploadteamsAction() {
	
	$dm = $this->getServiceLocator()->get('doctrine.documentmanager.odm_default');
	
	$request = $this->getRequest();
	if ($request->isPost()){
		
		/*
		 * Create adapter to handle csv parsing
		 */
		$adapter = new Http();
		$adapter->setDestination('public/teams');
		
		if (!$adapter->receive()) {
		   $messages = $adapter->getMessages();
		   echo implode("\n", $messages);	
	   }
	   
	   $file = $adapter->getFileName('csv');
	   $file_contents = file_get_contents($file);
	   $csv = array_map('str_getcsv', file($file));
	   
	   /*
		* Validator to check whether Team already exists in database
		*/
	   
	   $validator = new NoObjectExists(
				   array('object_manager' => $dm,
						 'object_repository' => $dm->getRepository('GameManager\Models\Team'),
						 'fields' => ['teamname'])
				   );
	   
		   foreach ($csv as $teams) {
			   
			   $team = new Team();
			   /*
				* Create validator to check if the team already exists in database
				* If it exists, do not entire it again, otherwise persist to database
				* 
				*/
   
			   if ($validator->isValid($teams[0])){
			   $team->setTeamname($teams[0]);
			   $team->setLeague($teams[1]);
			   $team->setSport($teams[2]);
			   $dm->persist($team);
			   $dm->flush();
			   }
		   }
	}
	
	return $this->redirect()->toRoute('findmygame/default',  array('controller' => 'TeamAdmin', 'action' => 'view'));
	
}


public function deleteteamAction()
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
		
		$repository = $dm->getRepository('GameManager\Models\Team');
		$team = $repository->find($id);
		
		 $request = $this->getRequest();
        if ($request->isPost()) {
            $del = $request->getPost('del', 'No');
            if ($del == 'Yes') {
                $id = $request->getPost('id');
				
				$team = $repository->find($id);
				$dm->remove($team);
				$dm->flush();
            }
            
           return $this->redirect()->toRoute('findmygame/default',  array('controller' => 'TeamAdmin', 'action' => 'view'));
        }
        return array(
            'id'    => $id,
            'team' => $team,
        );	
		
    }
}