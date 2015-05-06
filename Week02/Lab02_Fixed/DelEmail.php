<?php
namespace week2\cprince;
include './bootstrap.php';
use PDO;
/* 
 * DelEmail
 * 
 * 
 */
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Lab 02</title>
    </head>
    <body>
        <?php 
        
        
//        $emailid = filter_input(INPUT_GET, 'emailid'); 
//        Echo $emailid;
//        $dbConfig = array(
//            "DB_DNS"=>'mysql:host=localhost;port3306;dbname=PHPadvClassSpring2015',
//            "DB_USER"=>'root',
//            "DB_PASSWORD"=>''
//            );
//        
//        $pdo = new DB($dbConfig);
//                
//        $db = $pdo->getDB();
//        
//        $emailDAO = new emailDAO($db);
//        
//        if ($emailDAO->delete($emailid) === true)
//        {echo "Email Deleted";}
        
        
        
        
        $emailid = filter_input(INPUT_GET, 'emailid');
                   
        $dbConfig = array(
            "DB_DNS"=>'mysql:host=localhost;port=3306;dbname=PHPadvClassSpring2015',
            "DB_USER"=>'root',
            "DB_PASSWORD"=>''
        );
        
        $pdo = new DB($dbConfig);
        $db = $pdo->getDB();
        
         $emailDAO = new emailDAO($db);
           if ($emailDAO->delete($emailid))
           {echo "Email Deleted";}
        ?>
        <br />
        <a href="index.php">Back to main</a>
    </body>
</html>