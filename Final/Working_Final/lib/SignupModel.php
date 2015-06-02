<?php
class SignupModel {

    private $name;
    private $level;
   
    function getname() {
      
       return $this->name; 
        
    }
    function getLevel() {
        return $this->level;
    }
   
   
    function setname($name) {
        $this->name = $name;
    }
    function setLevel($level) {
        $this->level = $level;
    }
  
   
    public function map(array $values) {
        
        foreach ($values as $key => $value) {
            
           $method = 'set' . $key;
          
            if ( method_exists($this, $method) ) { 
                
               
                $this->$method($value);
                
                
            }      
            
        } 
        
        return $this;
    }
    
    public function reset() {
        
        $class_methods = get_class_methods($this);
        foreach ($class_methods as $method_username) {
           if ( strrpos($method_username, 'set', -strlen($method_username)) !== FALSE ) {
               $this->$method_username('');
           }
            
        } 
         return $this;
    }
}

