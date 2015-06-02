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
class gunService {
   
    private $_errors = array();
    private $_Util;
    private $_DB;
    private $_Validator;
    private $_gunDAO;
    private $_gunModel;


    public function __construct($db, $util, $validator, $gunDAO, $gunModel) {
        $this->_DB = $db;    
        $this->_Util = $util;
        $this->_Validator = $validator;
        $this->_gunDAO = $gunDAO;
        $this->_gunModel = $gunModel;
    }


    public function saveForm() {        
        if ( !$this->_Util->isPostRequest() ) {
            return false;
        }
        
        $this->validateForm();
        
        if ( $this->hasErrors() ) {
            $this->displayErrors();
        } else {
            
            if (  $this->_gunDAO->save($this->_gunModel) ) {
                echo 'gun Added';
            } else {
                echo 'gun could not be added Added';
            }
           
        }
        
    }
    public function validateForm() {
       
        if ( $this->_Util->isPostRequest() ) {                
            $this->_errors = array();
            if( !$this->_Validator->gunIsValid($this->_gunModel->getidFirearms()) ) {
                 $this->_errors[] = 'gun is invalid';
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


    public function displayguns() {        
       
        $stmt = $this->_DB->prepare("SELECT * FROM firearms");

        if ($stmt->execute() && $stmt->rowCount() > 0) {
            
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
           
            foreach ($results as $value) {
                echo '<p>', $value['name'], '</p>';
            }
        } else {
            echo '<p>No Data</p>';
        }
        
    }
    
    
}
