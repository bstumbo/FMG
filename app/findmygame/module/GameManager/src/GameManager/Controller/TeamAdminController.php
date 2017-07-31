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
            
             return $this->redirect()->toRoute('findmygame/default',  array('controller' => 'BarAdmin', 'action' => 'view'));
        }
         
        return array('form'=>$form);
    }
}