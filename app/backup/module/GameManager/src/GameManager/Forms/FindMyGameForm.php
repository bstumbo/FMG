<?php

namespace GameManager\Forms;

use Zend\Form\Form;


class FindMyGameForm extends Form
{
    public function __construct()
    {
        parent::__construct('FindMyGameForm');
        

    }

    public function init()
    {
        
        // Add form elements
   
        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'sports',
            'options' => array(
                'label' => 'Sports',
                'value_options' => array(
                    'NULL' => 'Sport',
                    '0' => 'Baseball',
                    '1' => 'Soccer',
                   
                ),
            )
            
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'leagues',
            'options' => array(
                'label' => 'Leagues',
                'value_options' => array(
                    'NULL' => 'League',
                    '0' => 'MLB',
                    '1' => 'MLS',
                    '2' => 'Euro Cup',
                ),
            )
           
        ));
        
         $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'affiliations',
            'options' => array(
                'label' => 'Affiliations:',
                'value_options' => array(
                   'NULL' => 'Team',
                ),
            )
           
        ));
         
         
        $this->add(array(
            'name' => 'submit',
            'type' => 'Zend\Form\Element\Submit',
            'options' => array(
                'label' => 'Sumbit'
            ),
            'attributes' => array(
                'class' => 'btn btn-default'
            )
        ));

        $this->get('submit')->setValue('Submit');
    }
}
