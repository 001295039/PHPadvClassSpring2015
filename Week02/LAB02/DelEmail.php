<?php
include './bootstrap.php';
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
        
        Echo "Email Deleted";
        $emailid = filter_input(INPUT_GET, 'emailid'); 
        Echo $emailid;
        $dbConfig = array(
            "DB_DNS"=>'mysql:host=localhost;port3306;dbname=PHPadvClassSpring2015',
            "DB_USER"=>'root',
            "DB_PASSWORD"=>''
            );
        
        $pdo = new DB($dbConfig);
        $db = $pdo->getDB();
        
        $emailDAO = new EmailDAO($db);
        $emailDAO->delete($emailid);
        ?>
        <a href="index.php">Back to main</a>
    </body>
</html>




