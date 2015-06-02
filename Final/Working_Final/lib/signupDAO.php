<?php
class SignupDAO {
    
    private $DB = null;
    private $model = null;
    public function __construct( PDO $db, $model ) {        
        $this->setDB($db);
        $this->setModel($model);
    }
    
    private function setDB( PDO $DB) {        
        $this->DB = $DB;
    }
    
    private function getDB() {
        return $this->DB;
    }
    
    private function getModel() {
        return $this->model;
    }
    private function setModel($model) {
        $this->model = $model;
    }
    
    public function login($model) {
         
        $email = $model->getname();
        $password = $model->getLevel();
        $db = $this->getDB();
          
        $stmt = $db->prepare("SELECT * FROM person WHERE name = :name");
  
        if ( $stmt->execute(array(':name' => $email)) && $stmt->rowCount() > 0 ) {            
            $results = $stmt->fetch(PDO::FETCH_ASSOC); 
           
                var_dump(password_verify($password, $results['level']));
            return password_verify($password, $results['level']); 
                 
        }
         
        return false;
    }
    
    
    public function create($model) {
                 
        $db = $this->getDB();
        $binds = array( 
            ":name" => $model->getname(),
                        ":level" => password_hash($model->getLevel(), PASSWORD_DEFAULT)
                    );
                   
        $stmt = $db->prepare("INSERT INTO person SET name = :name, level = :level");
         
        if ( $stmt->execute($binds) && $stmt->rowCount() > 0 ) {
            return true;
        }
         
         return false;
    }
    
    
    public function update($model) {
          
        $db = $this->getDB();
        $binds = array( ":owner_id" => $model->getowner_id(),
            ":name" => $model->getname(),
                        ":level" => password_hash($model->getLevel(), PASSWORD_DEFAULT)
                    );
        $stmt = $db->prepare("UPDATE person SET name = :name, level = :level WHERE userid = :owner_id");
        if ($stmt->execute($binds) && $stmt->rowCount() > 0) {
            return true;
        }
        return false;
    }
          
}