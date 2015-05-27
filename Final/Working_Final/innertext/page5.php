<?php 
include './bootstrap.php';
?>

<p>This is the update page.</p>


        <?php
        $dbConfig = array(
    "DB_DNS"=>'mysql:host=localhost;port=3306;dbname=FirearmsDB',
    "DB_USER"=>'root',
    "DB_PASSWORD"=>''
        );
        
        $pdo = new DB($dbConfig);
        $db = $pdo->getDB();
  
        $util = new Util();
        $gunDAO = new gunDAO($db);
        $gunModel = new gunModel();
        $validator = new Validator();
        $errors = array();

        if($util->isPostRequest())
        { echo "Mega Tacos";
            $gunModel->map(filter_input_array(INPUT_POST));}
        else
        {
            $idFirearms = filter_input(INPUT_GET, 'idfirearms');
            $gunModel = $gunDAO->getById($idFirearms);
        }

        $idFirearms = $gunModel->getidFirearms();
        $gunName = $gunModel->getname();
        $caliber = $gunModel->getcaliber();
        $serialNum = $gunModel->getsernum();
        $manuf = $gunModel->getmanuf();
        $price = $gunModel->getprice();
        $ownerID = $gunModel->getowner_id();

        
        if ($util->isPostRequest())
        {
            $idFirearms = filter_input(INPUT_GET, 'idFirearms');
            $gunModel = $gunDAO->getById($idFirearms);
            
        
        $gunName = filter_input(INPUT_POST, 'gunName');
        $caliber = filter_input(INPUT_POST, 'caliber');
        $serialNum = filter_input(INPUT_POST, 'serialNum');
        $manuf = filter_input(INPUT_POST, 'manuf');
        $price = filter_input(INPUT_POST, 'price');
        $ownerID = filter_input(INPUT_POST, 'ownerid');
            
            
            if(!$validator->gunIsValid($gunName))
            {$errors[] = 'Firearm is Invalid.';}
            
            //if(!$validator->activeIsValid($active))
            //{$errors[] = 'Active is invalid';}

            if(count($errors) > 0 )
            {
                foreach ($errors as $value)
                {echo'<p>',$value,'</p>';}
            }
            else 
            {
            if($gunDAO->idExisit($gunModel->getidFirearms()))
            {
            $gunModel->map(filter_input_array(INPUT_POST));            
            if($gunDAO->save($gunModel));
            {echo "Firearm Updated.";}
            }
            }
        }
        
        var_dump($idFirearms);
        ?>
        
        <h3>Update Firearm</h3>
        <form action="#" method="post">
            
            
            <label>Firearm:</label>            
            <input type="text" name="gunName" value="<?php echo $gunName; ?>" placeholder="" />
            <br /><br />
            
            <label>Caliber:</label>
            <input type="text" name="caliber" value="<?php echo $caliber; ?>" />
            <br /><br />
            
            <label>Serial Number:</label>
            <input type="text" name="serialNum" value="<?php echo $serialNum; ?>" />
            <br /><br />
            
            <label>Manufacturer:</label>
            <input type="text" name="manuf" value="<?php echo $manuf; ?>" />
            <br /><br />
            
            <label>Price:</label>
            <input type="text" name="price" value="<?php echo $price; ?>" />
            <br /><br />
            
            <label>Owner ID:</label>
            <input type="text" name="ownerID" value="<?php echo $ownerID; ?>" />
            <br /><br />

            
            <input type="submit" value="Submit" />
        </form>
        
        <?php
       echo '<p><a href="page4.php">Back to main</a></p>';
        ?>