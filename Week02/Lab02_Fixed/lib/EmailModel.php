<?php
namespace week2\cprince;


/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of EmailModel
 *
 */
class EmailModel implements IModel{
    private $emailid;
    private $email;
    private $emailtypeid;
    private $emailtype;
    private $logged;
    private $lastupdated;
    private $active;
    private $emailtypeactive;
    
    function getEmailid() {
        return $this->emailid;
    }

    function getEmail() {
        return $this->email;
    }

    function getEmailtypeid() {
        return $this->emailtypeid;
    }

    function getLogged() {
        return $this->logged;
    }

    function getLastupdated() {
        return $this->lastupdated;
    }

    function getActive() {
        return $this->active;
    }

    function setEmailid($emailid) {
        $this->emailid = $emailid;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setEmailtypeid($emailtypeid) {
        $this->emailtypeid = $emailtypeid;
    }

    function setLogged($logged) {
        $this->logged = $logged;
    }

    function setLastupdated($lastupdated) {
        $this->lastupdated = $lastupdated;
    }

    function setActive($active) {
        $this->active = $active;
    }

    function getEmailtypeactive() {
        return $this->emailtypeactive;
    }

    function setEmailtypeactive($emailtypeactive) {
        $this->emailtypeactive = $emailtypeactive;
    }

    function getEmailtype() {
        return $this->emailtype;
    }

    function setEmailtype($emailtype) {
        $this->emailtype = $emailtype;
    }

        
    public function reset() {
        $this->setEmailid('');
        $this->setEmail('');
        $this->setEmailtypeid('');
        $this->setEmailtype('');
        $this->setEmailtypeactive('');
        $this->setActive('');
        $this->setLogged('');
        $this->setLastupdated('');
        return $this;
    }
    
    public function map(Array $values) {
        
        if(array_key_exists('emailid', $values))
        {
            $this->setEmailid($values['emailid']);
        }
        
        if(array_key_exists('email', $values))
        {
            $this->setEmail($values['email']);
        }
        
        if ( array_key_exists('emailtypeid', $values) ) 
        {
            $this->setEmailtypeid($values['emailtypeid']);
        }
        
        if ( array_key_exists('emailtype', $values) ) 
        {
            $this->setEmailtype($values['emailtype']);
        }
        
        if(array_key_exists('emailtypeactive', $values))
        {
            $this->setEmailtypeactive($values['emailtypeactive']);
        }
        
        if ( array_key_exists('active', $values) ) 
        {
            $this->setActive($values['active']);
        }
        
        if(array_key_exists('logged', $values))
        {
            $this->setLogged($values['logged']);
        }
        
        if(array_key_exists('lastupdated', $values))
        {
            $this->setLastupdated($values['lastupdated']);
        }
        return $this;
    }
    
    


    
    
}
