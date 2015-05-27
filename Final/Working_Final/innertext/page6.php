<?php
include './bootstrap.php';
//use PDO;
?>
<p>This is the delete page.</p>

        <?php 
        
        $idFirearms = filter_input(INPUT_GET, 'idFirearms');
                   
        $dbConfig = array(
    "DB_DNS"=>'mysql:host=localhost;port=3306;dbname=FirearmsDB',
    "DB_USER"=>'root',
    "DB_PASSWORD"=>''
        );
        
        $pdo = new DB($dbConfig);
        $db = $pdo->getDB();
        
         $gunDAO = new gunDAO($db);
         
           if ($gunDAO->delete($idFirearms))
           {echo "Gun Deleted";}
           else
           {echo "Something broke. Don't ask what because I don't know.";}
        ?>
        <br />
        <a href="page4.php">Back to views</a>
    