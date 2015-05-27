<?php 
include './bootstrap.php';
?> 
<?php
                
        $dbConfig = array(
            "DB_DNS"=>'mysql:host=localhost;port=3306;dbname=FirearmsDB',
            "DB_USER"=>'root',
            "DB_PASSWORD"=>''
        );
        
        $pdo = new DB($dbConfig);
        $db = $pdo->getDB();
        
          $idFirearms = filter_input(INPUT_POST, 'idFirearms');
        $gunName = filter_input(INPUT_POST, 'name');
        $caliber = filter_input(INPUT_POST, 'caliber');
        $serialNum = filter_input(INPUT_POST, 'sernum');
        $manuf = filter_input(INPUT_POST, 'manuf');
        $price = filter_input(INPUT_POST, 'price');
        $ownerID = filter_input(INPUT_POST, 'owner_id');
        
         $gunDAO = new gunDAO($db);
        
         
         
        
         $util = new Util();
         
          if ( $util->isPostRequest() ) {
                            
               $validator = new Validator(); 
                $errors = array();
                if( !$validator->gunIsValid($gunName)) {
                    $errors[] = 'firearm name is invalid';
                } 
                
                if ( !$validator->caliberIsValid($caliber) ) {
                     $errors[] = 'caliber is invalid';
                }
                
                if ( !$validator->sernumIsValid($serialNum) ) {
                     $errors[] = 'serialNum is invalid';
                }
                 if ( !$validator->manufIsValid($manuf) ) {
                     $errors[] = 'manufacturer is invalid';
                }
                 if ( !$validator->priceIsValid($price) ) {
                     $errors[] = 'price is invalid';
                }
                
                if ( count($errors) > 0 ) {
                    foreach ($errors as $value) {
                        echo '<p>',$value,'</p>';
                    }
                } else {
                    
                    
                   
                    
                  $gunModel = new gunModel();
                    
                    $gunModel->map(filter_input_array(INPUT_POST));
                    
                   // var_dump($emailtypeModel);
                    if ( $gunDAO->create($gunModel) ) {
                        echo 'firearm Added';
                    } else {
                        echo 'firearm not added';
                    }
                    
                }
          }
        
        ?>
<h3>Add Firearm</h3>
        <form action="#" method="post">
            <label>Firearm name:</label> 
            <input type="text" name="name" value="" placeholder="" />
            <br /><br />
            <label>Caliber:</label>
             <input type="text" name="caliber" value="" placeholder="" />
             <br /><br />
             <label>Serial number:</label>
             <input type="text" name="sernum" value="" placeholder="" />
             <br /><br />
             <label>Manufacturer:</label>
             <input type="text" name="manuf" value="" placeholder="" />
             <br /><br />
              <label>Sale price:</label>
             <input type="text" name="price" value="" placeholder="" />
             <br /><br />
              <label>owner id:</label>
              <input type="text" name="owner_id" value="1" readonly="true" placeholder="" />
            <input type="submit" value="Submit" />
        </form>
 