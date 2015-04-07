<?php include './bootstrap.php'; ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        
        $dbConfig = array(
            "DB_DNS"=>'mysql:host=localhost;port=3306;dbname=PHPadvClassSpring2015',
            "DB_USER"=>'root',
            "DB_PASSWORD"=>''
        );

        $pdo = new DB($dbConfig);
        $db = $pdo->getDB();

        $phoneType = filter_input(INPUT_POST, 'phonetype');
        $active = filter_input(INPUT_POST, 'active');
        
        $util = new Util();
       
            
            if ( $util->isPostRequest() ) {
                $validator = new Validator(); 
                $errors = array();
                if( !$validator->phoneTypeIsValid($phoneType) ) {
                    $errors[] = 'Phone Type is invalid';
                } 
                
                if ( !$validator->activeIsValid($active) ) {
                     $errors[] = 'Active is invalid';
                }
                
                
                
                if ( count($errors) > 0 ) {
                    foreach ($errors as $value) {
                        echo '<p>',$value,'</p>';
                    }
                } else {
                    /*
                    * Fax,Home,Moble,Pager,Work
                    */
                   
                    $phoneTypeDAO = new PhoneTypeDAO($db);
                   
                    $phonetypeModel = new PhoneTypeModel();
                    $phonetypeModel->setActive($active);
                    $phonetypeModel->setPhonetype($phoneType);
                    
                   // var_dump($phonetypeModel);
                    if ( $phoneTypeDAO->save($phonetypeModel) ) {
                        echo 'Phone Added';
                    }
                    
                               
                    
                }
                
                
            }
        
        ?>
        
        
         <h3>Add phone type</h3>
        <form action="#" method="post">
            <label>Phone Type:</label> 
            <input type="text" name="phonetype" value="<?php echo $phoneType; ?>" placeholder="" />
            <br /><br />
            <label>Active:</label>
            <input type="number" max="1" min="0" name="active" value="<?php echo $active; ?>" />
             <br /><br />
            <input type="submit" value="Submit" />
        </form>
         
         
         <?php         
             $stmt = $db->prepare("SELECT * FROM phonetype");
         
            if ( $stmt->execute() && $stmt->rowCount() > 0 ) {
                $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

                 foreach ($results as $value) {
                       echo '<p>',$value['phonetype'],'</p>';
                   }

            } else {
                echo '<p>No Data</p>';
            }
         ?>
         
         
    </body>
</html>
