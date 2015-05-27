<?php
namespace BradS\week2;
use \PDO;
/**
 * Description of PhotoTypeModel
 * 
 * The idea of the model(Data Object) is to provide an object the reflects your
 * table in your database.  Notice all the private variables are the colums from
 * the table in our database.
 * 
 * One word of advise, keep all table names in your models class lowercase.  When creating 
 * getter and setter functions it will camel case (Java Style) your functions.
 *
 * @author User
 */
class emailTypeModel implements IModel {
    
    private $emailtypeid;
    private $emailtype;
    private $active;
    
    function getemailtypeid() {
        return $this->emailtypeid;
    }

    function getemailtype() {
        return $this->emailtype;
    }

    function getActive() {
        return $this->active;
    }

    function setemailtypeid($emailtypeid) {
        $this->emailtypeid = $emailtypeid;
    }

    function setemailtype($emailtype) {
        $this->emailtype = $emailtype;
    }

    function setActive($active) {
        $this->active = $active;
    }

    /*
     * When a class has to implement an interface those functions must be created in the class.
     */
    
    public function reset() {
        $this->setemailtypeid('');
        $this->setemailtype('');
        $this->setActive('');
        return $this;
    }
    
    public function map(Array $values) {
        
        if ( array_key_exists('emailtypeid', $values) ) {
            $this->setemailtypeid($values['emailtypeid']);
        }
        
        if ( array_key_exists('emailtype', $values) ) {
            $this->setemailtype($values['emailtype']);
        }
        
        if ( array_key_exists('active', $values) ) {
            $this->setActive($values['active']);
        }
        return $this;
    }

}
