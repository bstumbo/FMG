<?php

namespace GameManager\Models;
 
use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;
 
class Image implements InputFilterAwareInterface
{
    public $barimage;
    protected $inputFilter;
     
    public function exchangeArray($data)
    {
        
        $this->fileupload  = (isset($data['barimage']))  ? $data['barimage']     : null; 
    } 
     
    public function setInputFilter(InputFilterInterface $inputFilter)
    {
        throw new \Exception("Not used");
    }
     
    public function getInputFilter()
    {
        if (!$this->inputFilter) {
            $inputFilter = new InputFilter();
            $factory     = new InputFactory();
              
             
            $inputFilter->add(
                $factory->createInput(array(
                    'name'     => 'barimage',
                    'required' => true,
                ))
            );
             
            $this->inputFilter = $inputFilter;
        }
         
        return $this->inputFilter;
    }
}