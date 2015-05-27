<?php
/**
 * PhoneModel
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


class gunModel implements IModel {
    
    private $idFirearms;
    private $name;
    private $caliber;
    private $sernum;
    private $manuf;
    private $price;
    private $logged;
    private $lastupdated;
   
    
    function getidFirearms() {
        return $this->idFirearms;
    }

    function getname() {
        return $this->name;
    }

    function getcaliber() {
        return $this->caliber;
    }
    
     function getsernum() {
        return $this->sernum;
    }

    function getmanuf() {
        return $this->manuf;
    }
 function getprice() {
        return $this->price;
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

    function setidFirearms($idFirearms) {
        $this->idFirearms = $idFirearms;
    }

    function setname($name) {
        $this->name = $name;
    }

    function setcaliber($caliber) {
        $this->caliber = $caliber;
    }

    function setsernum($sernum) {
        $this->sernum = $sernum;
    }

    function setmanuf($manuf) {
        $this->manuf = $manuf;
    }
    
    function setprice($price) {
        $this->price = $price;
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
    
    /*
    * When a class has to implement an interface those functions must be created in the class.
    */
    public function reset() {
        $this->setidFirearms('');
        $this->setname('');
        $this->setcaliber('');
        $this->setsernum('');
        $this->setmanuf('');
        $this->setprice('');
        $this->setLogged('');
        $this->setLastupdated('');
        $this->setActive('');
        return $this;
    }
    
    
   
    public function map(array $values) {
        
        if ( array_key_exists('idFirearms', $values) ) {
            $this->setidFirearms($values['idFirearms']);
        }
        
        if ( array_key_exists('name', $values) ) {
            $this->setname($values['name']);
        }
        
        if ( array_key_exists('caliber', $values) ) {
            $this->setcaliber($values['caliber']);
        }
        
        if ( array_key_exists('sernum', $values) ) {
            $this->setsernum($values['sernum']);
        }
        
        if ( array_key_exists('manuf', $values) ) {
            $this->setmanuf($values['manuf']);
        }
          if ( array_key_exists('price', $values) ) {
            $this->setprice($values['price']);
        }
        if ( array_key_exists('logged', $values) ) {
            $this->setLogged($values['logged']);
        }
        
        if ( array_key_exists('lastupdated', $values) ) {
            $this->setLastupdated($values['lastupdated']);
        }
        
        if ( array_key_exists('active', $values) ) {
            $this->setActive($values['active']);
        }
        return $this;
    }


}
