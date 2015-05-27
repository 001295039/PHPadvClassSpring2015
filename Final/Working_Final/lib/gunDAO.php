<?php
/**
 * PhoneDAO
 * 
 * DAO = Data Access Object
 * 
 * The idea of a Data Access object is a class the will simply execute crud 
 * operations for your database.  We want to be able to create a DAO for each
 * table in your database.
 * 
 * CRUD = (Create Read Update Disable/Delete)
 *
 * @author User
 */

// *** NOTE this class is not complete and does not work
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
         
         $model = new emailModel(); // this creates a dependacy, how can we fix this
         $db = $this->getDB();
         
         $stmt = $db->prepare("SELECT firearms.idFirearms, firearms.name, firearms.caliber, firearms.sernum, firearms.manuf, firearms.price, firearms.logged, firearms.lastupdated"
                 . " FROM firearms LEFT JOIN person on firearms.owner_id = person.userid WHERE idFirearms = :idFirearms");
         
         if ( $stmt->execute(array(':emailid' => $id)) && $stmt->rowCount() > 0 ) {
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
                ":price" => $model->getprice()
                    );
                    
         if ( !$this->idExisit($model->getidFirearms()) ) {
             
             $stmt = $db->prepare("INSERT INTO firearms SET name = :name, caliber = :caliber, sernum = :sernum, manuf = :manuf, price = :price, owner_id = 1, logged = now(), lastupdated = now()");
             
             if ( $stmt->execute($binds) && $stmt->rowCount() > 0 ) {
                return true;
              
             }
             else{
                // var_dump($db->errorInfo());
             }
             }
     }
    
    public function save(IModel $model) {
                 
         $db = $this->getDB();
         
         $binds = array( ":name" => $model->getemail(),
                          ":active" => $model->getActive(),
                         ":idFirearms" => $model->getemailTypeid() ,
                ":sernum" => $model->getemailid(),
                         ":manuf" => $model->getemailTypeid() ,
                ":price" => $model->getemailid()
                    );
         
                    var_dump($binds); 
         if ( $this->idExisit($model->getEmailid()) ) {
            
             $stmt = $db->prepare("UPDATE email SET email = :email, active = :active, emailtypeid = :emailtypeid WHERE emailid = :emailid");
         
             if ( $stmt->execute($binds) && $stmt->rowCount() > 0 ) {
                return true;
             } else {
                 return false;
             }
             
         } 
    }
    
    
    public function delete($id) {
          
         $db = $this->getDB();         
         $stmt = $db->prepare("Delete FROM firearms WHERE idfirearms = :idfirearms");
         
         if ( $stmt->execute(array(':emailid' => $id)) && $stmt->rowCount() > 0 ) {
             return true;
         }
         
         return false;
    }
     
    
    
    public function getAllRows() {
       
        $values = array();         
        $db = $this->getDB();               
        $stmt = $db->prepare("SELECT firearms.idFirearms, firearms.name, firearms.caliber, firearms.sernum, firearms.manuf, firearms.price, firearms.logged, firearms.lastupdated"
                 . " FROM firearms LEFT JOIN person on firearms.owner_id = person.userid WHERE idFirearms = :idFirearms");
        
        if ( $stmt->execute() && $stmt->rowCount() > 0 ) {
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($results as $value) {
               $model = new emailModel();
               $model->reset()->map($value);
               $values[] = $model;
            }
             
        }   else {            
           //log($db->errorInfo() .$stmt->queryString ) ;           
        }  
        
        $stmt->closeCursor();         
         return $values;
     }
}
