<?php

// *** NOTE this class is not complete and might not work
class gunDAO implements IDAO {
    
    private $DB = null;

    public function __construct( PDO $db ) {        
        $this->setDB($db);    
    }
    
    private function setDB( PDO $DB) {        
        $this->DB = $DB;
    }
    
    private function getDB() {
        return $this->DB;
    }
    
    public function idExisit($id) {
        
        $db = $this->getDB();
        $stmt = $db->prepare("SELECT idFirearms FROM Firearms WHERE idFirearms = :idFirearms");
         
        if ( $stmt->execute(array(':idFirearms' => $id)) && $stmt->rowCount() > 0 ) {
            return true;
        }
         return false;
    }
    
    public function getById($id) {
         
         $model = new gunModel(); // this creates a dependacy, how can we fix this
         $db = $this->getDB();
         
         $stmt = $db->prepare("SELECT idFirearms, name, caliber, sernum, manuf, price, owner_id"
                 . " FROM firearms WHERE idFirearms = :idFirearms");
         
         if ( $stmt->execute(array(':idFirearms' => $id)) && $stmt->rowCount() > 0 ) {
             $results = $stmt->fetch(PDO::FETCH_ASSOC);
             $model->map($results);
         }
      
          
         return $model;
         
    }
     public function create(IModel $model) {
                 
         $db = $this->getDB();
         
       $binds = array( ":name" => $model->getname(),
                          ":caliber" => $model->getcaliber(),    
                ":sernum" => $model->getsernum(),
                         ":manuf" => $model->getmanuf() ,
                ":price" => $model->getprice(),
           ":owner_id" => $model->getowner_id()
                    );
                     
         if ( !$this->idExisit($model->getidFirearms()) ) {
             
             $stmt = $db->prepare("INSERT INTO firearms SET name = :name, caliber = :caliber, sernum = :sernum, manuf = :manuf, price = :price, owner_id = :owner_id");
           
             if ( $stmt->execute($binds) && $stmt->rowCount() > 0 ) {
               
               return true;
              
             }
             else{
             var_dump($db->errorInfo());    
             }
             
             }
     }
    
    public function save(IModel $model) {
                 
         $db = $this->getDB();
         
         $binds = array(":idFirearms" => $model->getidFirearms(),
             ":name" => $model->getname(),
                        ":caliber" => $model->getcaliber(),
                        ":sernum" => $model->getsernum(),
                        ":manuf" => $model->getmanuf(),
                        ":price" => $model->getprice() ,
                        ":owner_id" => $model->getowner_id()
                    );

         if ( $this->idExisit($model->getidFirearms()) ) {
            
             $stmt = $db->prepare("UPDATE firearms SET name = :name, caliber = :caliber, sernum = :sernum, manuf = :manuf, price = :price, owner_id = :owner_id WHERE idFirearms = :idFirearms");
         
             if ( $stmt->execute($binds) && $stmt->rowCount() > 0 ) {
                return true;
             } else {
                 return false;
             }
             
         } 
    }
    
    
    public function delete($idfirearms) {
          
         $db = $this->getDB();         
         $stmt = $db->prepare("Delete FROM firearms WHERE idfirearms = :idfirearms");
         
         if ( $stmt->execute(array(':idfirearms' => $idfirearms)) && $stmt->rowCount() > 0 ) {
             return true;
         }
         
         return false;
    }
     
    
    
public function getAllRows() {
       
        $values = array();         
        $db = $this->getDB();               
        $stmt = $db->prepare("SELECT idFirearms, name, caliber, sernum, manuf, price, owner_id"
                 . " FROM firearms WHERE idFirearms = idFirearms");
        
        if ( $stmt->execute() && $stmt->rowCount() > 0 ) {
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($results as $value) {
               $model = new gunModel();
               $model->reset()->map($value);
               $values[] = $model;
            }  
            
        }
        else {            
           var_dump($db->errorInfo()); //log($db->errorInfo() .$stmt->queryString ) ;           
        }  
           
        $stmt->closeCursor();         
         return $values;
         
     }
}