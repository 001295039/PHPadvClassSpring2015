<?php
namespace week2\cprince;
include './bootstrap.php';
use PDO;
?>



<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Lab 02</title>
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
        $emailDAO = new EmailDAO($db);
        $emailModel = new EmailModel();
        $validator = new Validator();
        $errors = array();
        $emailTypeDAO = new EmailTypeDAO($db);
        
        $emailTypes = $emailTypeDAO->getAllRows();
        
        if($util->isPostRequest())
        {
            $emailModel->map(filter_input_array(INPUT_POST));
        }
        else
        {
            $emailid = filter_input(INPUT_GET, 'emailid');
            $emailModel = $emailDAO->getById($emailid);
        }
        
       
        $emailid = $emailModel->getEmailid();
        $email = $emailModel->getEmail();
        $active = $emailModel->getActive();
        $emailTypeid = $emailModel->getEmailtypeid();
        $emailType = $emailModel->getEmailtype();
        
        if ($util->isPostRequest())
        {
            $emailid = filter_input(INPUT_GET, 'emailid');
            $emailModel = $emailDAO->getById($emailid);
            
            $email = filter_input(INPUT_POST, 'email');
            $emailtypeid = filter_input(INPUT_POST, 'emailtypeid');
            $active = filter_input(INPUT_POST, 'active');
            
            if(!$validator->emailIsValid($email))
            {
                $errors[] = 'Email is Invalid.';
            }
            
            if(!$validator->activeIsValid($active))
            {
                $errors[] = 'Active is invalid';
            }

            
            if(count($errors) > 0 )
            {
                foreach ($errors as $value)
                {
                  
                    echo'<p>',$value,'</p>';
                }
            }
            else 
            {
                 
                       
                     
                       if($emailDAO->idExisit($emailModel->getEmailid()))
                       {
                           
                            $emailModel->map(filter_input_array(INPUT_POST));            
                            /*$email = $emailModel->setEmail();
                            $active = $emailModel->setActive();
                            $emailTypeid = $emailModel->setEmailtypeid();
                            $emailType = $emailModel->setEmailtype();*/
                            
                           if($emailDAO->save($emailModel));
                            {
                                echo "Email Updated.";
                            }
                        }
            }
        }
        
        ?>
        
        <h3>Update Email</h3>
        <form action="#" method="post">
            <label>Email:</label>            
            <input type="text" name="email" value="<?php echo $email; ?>" placeholder="" />
            
            <br /><br />
            
            <label>Active:</label>
            <input type="number" max="1" min="0" name="active" value="<?php echo $active; ?>" />
            
            <br /><br />
            
            <label>Email Type:</label>
            <select name="emailtypeid">
            <?php 
                foreach ($emailTypes as $value) 
                    {
                    if ( $value->getEmailtypeid() == $emailTypeid) 
                    {
                        echo '<option value="',$value->getEmailtypeid(),'" selected="selected">',$value->getEmailtype(),'</option>';  
                    } else {
                        echo '<option value="',$value->getEmailtypeid(),'">',$value->getEmailtype(),'</option>';
                    }
                }
            ?>
            </select>
            
             <br /><br />
            <input type="submit" value="Submit" />
        </form>
        
        
        <?php
       echo '<p><a href="index.php">Back to Previous Page</a></p>';
        ?>
    </body>
</html>