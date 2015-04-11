<?php
namespace week2\cprince;
include './bootstrap.php';
use PDO;


$dbConfig = array(
    "DB_DNS"=>'mysql:host=localhost;port=3306;dbname=PHPadvClassSpring2015',
    "DB_USER"=>'root',
    "DB_PASSWORD"=>''
        );
    $pdo = new DB($dbConfig);
    $db = $pdo->getDB();
    $emailDAO = new EmailDAO($db);
    
  $emailTypeDAO = new EmailTypeDAO($db);
  $emailTypes = $emailTypeDAO->getAllRows();   
  $email = filter_input(INPUT_POST, 'email');
        $emailTypeid = filter_input(INPUT_POST, 'emailtypeid');
        $active = filter_input(INPUT_POST, 'active');
        
        $emailid = filter_input(INPUT_GET, 'emailid');
        
        var_dump($emailDAO->getById($emailid));
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
        <title>Lab 02</title>
    </head>
    <body>
        
        <h3>Update email</h3>
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
        
                foreach ($emailTypes as $value) {
                    if ( $value->getEmailtypeid() == $emailTypeid ) {
                        echo '<option value="',$value->getEmailtypeid(),'" selected="selected">',$value->getEmailtype(),'</option>';  
                    } else {
                        echo '<option value="',$value->getEmailtypeid(),'">',$value->getEmailtype(),'</option>'; } } 
                        ?>
</select>
<br /><br />
<input type="submit" value="Submit" />
</form>
        
        <br />
        <a href="index.php">Back to main</a>
        
    </body>
</html>