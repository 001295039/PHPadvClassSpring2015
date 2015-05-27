<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PhoneTypeService
 *
 * @author User
 */
namespace BradS\week2;
use \PDO;
class emailTypeService {
   
    private $_errors = array();
    private $_Util;
    private $_DB;
    private $_Validator;
    private $_emailTypeDAO;
    private $_emailTypeModel;


    public function __construct($db, $util, $validator, $emailTypeDAO, $emailtypeModel) {
        $this->_DB = $db;    
        $this->_Util = $util;
        $this->_Validator = $validator;
        $this->_emailTypeDAO = $emailTypeDAO;
        $this->_emailTypeModel = $emailtypeModel;
    }


    public function saveForm() {        
        if ( !$this->_Util->isPostRequest() ) {
            return false;
        }
        
        $this->validateForm();
        
        if ( $this->hasErrors() ) {
            $this->displayErrors();
        } else {
            
            if (  $this->_emailTypeDAO->save($this->_emailTypeModel) ) {
                echo 'email Added';
            } else {
                echo 'email could not be added Added';
            }
           
        }
        
    }
    public function validateForm() {
       
        if ( $this->_Util->isPostRequest() ) {                
            $this->_errors = array();
            if( !$this->_Validator->emailTypeIsValid($this->_emailTypeModel->getemailtype()) ) {
                 $this->_errors[] = 'email Type is invalid';
            } 
            if( !$this->_Validator->activeIsValid($this->_emailTypeModel->getActive()) ) {
                 $this->_errors[] = 'Active is invalid';
            } 
        }
         
    }
    
    
    public function displayErrors() {
       
        foreach ($this->_errors as $value) {
            echo '<p>',$value,'</p>';
        }
         
    }
    
    public function hasErrors() {        
        return ( count($this->_errors) > 0 );        
    }


    public function displayemails() {        
       
        $stmt = $this->_DB->prepare("SELECT * FROM emailtype");

        if ($stmt->execute() && $stmt->rowCount() > 0) {
            
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
           
            foreach ($results as $value) {
                echo '<p>', $value['emailtype'], '</p>';
            }
        } else {
            echo '<p>No Data</p>';
        }
        
    }
    
    
}
