<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of gunService
 *
 * @author Brad and Carl
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
    // Update validation   
        if ( !$this->_Util->isPostRequest() ) {
            return false;
        }
        
        $this->validateForm();
        
        if ( $this->hasErrors() ) {
            $this->displayErrors();
        } else {
            //Checks to see if it updated properly
            if (  $this->_gunDAO->save($this->_gunModel) ) {
                //echo's out statements to the user 
                echo 'gun Added';
            } else {
                echo 'gun could not be added Added';
            }
           
        }
        
    }
    public function validateForm() {
       //Validation
        if ( $this->_Util->isPostRequest() ) {                
            $this->_errors = array();
            if( !$this->_Validator->gunIsValid($this->_gunModel->getidFirearms()) ) {
                 $this->_errors[] = 'gun is invalid';
            } 
        }
         
    }
    
    
    public function displayErrors() {
       //Error Display
        foreach ($this->_errors as $value) {
            echo '<p>',$value,'</p>';
        }
         
    }
    
    public function hasErrors() {   
        //checks to see if there are errors
        return ( count($this->_errors) > 0 );        
    }


    public function displayguns() {        
       //Displays firearms
        $stmt = $this->_DB->prepare("SELECT * FROM firearms");

        if ($stmt->execute() && $stmt->rowCount() > 0) {
            
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
           //Echo's out values
            foreach ($results as $value) {
                echo '<p>', $value['name'], '</p>';
            }
        } else {
            echo '<p>No Data</p>';
        }
        
    }
    
    
}
