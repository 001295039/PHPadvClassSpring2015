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
class emailService {
   
    private $_errors = array();
    private $_Util;
    private $_DB;
    private $_Validator;
    private $_emailTypeDAO;
    private $_emailModel;


    public function __construct($db, $util, $validator, $emailDAO, $emailModel) {
        $this->_DB = $db;    
        $this->_Util = $util;
        $this->_Validator = $validator;
        $this->_emailDAO = $emailDAO;
        $this->_emailModel = $emailModel;
    }


    public function saveForm() {        
        if ( !$this->_Util->isPostRequest() ) {
            return false;
        }
        
        $this->validateForm();
        
        if ( $this->hasErrors() ) {
            $this->displayErrors();
        } else {
            
            if (  $this->_emailDAO->save($this->_emailModel) ) {
                echo 'email Added';
            } else {
                echo 'email could not be added Added';
            }
           
        }
        
    }
    public function validateForm() {
       
        if ( $this->_Util->isPostRequest() ) {                
            $this->_errors = array();
            if( !$this->_Validator->emailIsValid($this->_emailModel->getemail()) ) {
                 $this->_errors[] = 'email is invalid';
            } 
            if( !$this->_Validator->activeIsValid($this->_emailModel->getActive()) ) {
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
       
        $stmt = $this->_DB->prepare("SELECT * FROM email");

        if ($stmt->execute() && $stmt->rowCount() > 0) {
            
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
           
            foreach ($results as $value) {
                echo '<p>', $value['email'], '</p>';
            }
        } else {
            echo '<p>No Data</p>';
        }
        
    }
    
    
}
