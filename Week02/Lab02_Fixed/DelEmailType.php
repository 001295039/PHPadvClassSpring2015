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
            $emailtypeid = filter_input(INPUT_GET, 'emailtypeid');
           
            if ( NULL !== $emailtypeid ) 
            {
               $emailTypeDAO = new EmailTypeDAO($db);
               
               if ( $emailTypeDAO->delete($emailtypeid) ) 
               {
                   echo 'Email Type was deleted';                  
               }                
            }
             echo '<p><a href="',filter_input(INPUT_SERVER, 'HTTP_REFERER'),'">Back to email types</a></p>';
        
        ?>
    </body>
</html>
