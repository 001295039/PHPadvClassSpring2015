<?php 
namespace week2\cprince;
include './bootstrap.php'; 
?>

<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
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
        $util = new Util();
        $emailTypeDAO = new EmailTypeDAO($db);
        $validator = new Validator();
        $emailTypeModel = new EmailTypeModel();
        $errors = array();
        
        if ( $util->isPostRequest() ) 
        {
            
            $emailTypeModel->map(filter_input_array(INPUT_POST));
                       
        } else 
            {
            $emailTypeid = filter_input(INPUT_GET, 'emailtypeid');
            $emailTypeModel = $emailTypeDAO->getById($emailTypeid);
        }
        $emailTypeid = $emailTypeModel->getEmailtypeid();
        $emailType = $emailTypeModel->getEmailtype();
        $active = $emailTypeModel->getActive(); 

        if ($util->isPostRequest())
        {
            $emailTypeid = filter_input(INPUT_GET, 'emailtypeid');
            $emailTypeModel = $emailTypeDAO->getById($emailTypeid);
            $emailType = filter_input(INPUT_POST, 'emailtype');
            $active = filter_input(INPUT_POST, 'active');
        
            if(!$validator->emailTypeIsValid($emailType))
            {$errors[] = 'Email Type is invalid';}
            
            if(!$validator->activeIsValid($active))
            {$errors[] = 'Active is invalid';}
            
            if(count($errors) > 0 )
            {
                foreach ($errors as $value)
                {echo'<p>',$value,'</p>';}
            }
            else 
            {
            if($emailTypeDAO->idExisit($emailTypeModel->getEmailtypeid()))
            {
            $emailTypeModel->setActive($active);
            $emailTypeModel->setEmailtype($emailType);
                            
            if($emailTypeDAO->save($emailTypeModel));
            echo "Email Type Updated."; 
            }
            }
       }
       ?>
        <h3>Update Email type</h3>
        <form action="#" method="post">
            <label>Email Type:</label>
            <input type="text" name="emailtype" value="<?php echo $emailType; ?>" placeholder="" />
            <br /><br />
            <label>Active:</label>
            <input type="number" max="1" min="0" name="active" value="<?php echo $active; ?>" />

            <br /><br />
            <input type="submit" value="Submit" />
        </form>
        
        <?php echo '<p><a href="EmailType.php">Back to Previous Page</a></p>'; ?>
</body>
</html>
