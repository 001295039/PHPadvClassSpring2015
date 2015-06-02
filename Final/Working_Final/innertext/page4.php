<?php 
include './bootstrap.php'; 
?>

<p>Read Page</p>

<?php
                
    $dbConfig = array(
    "DB_DNS"=>'mysql:host=localhost;port=3306;dbname=FirearmsDB',
    "DB_USER"=>'root',
    "DB_PASSWORD"=>''
        );
        
    
        $pdo = new DB($dbConfig);
        $db = $pdo->getDB();

        
        $idFirearms = filter_input(INPUT_POST, 'idFirearms');
        $gunName = filter_input(INPUT_POST, 'gunName');
        $caliber = filter_input(INPUT_POST, 'caliber');
        $serialNum = filter_input(INPUT_POST, 'serialNum');
        $manuf = filter_input(INPUT_POST, 'manuf');
        $price = filter_input(INPUT_POST, 'price');
        $ownerID = filter_input(INPUT_POST, 'ownerid');
        
        $gunDAO = new gunDAO($db);

        //$email = filter_input(INPUT_POST, 'email');
        //$emailTypeid = filter_input(INPUT_POST, 'emailtypeid');
        //$active = filter_input(INPUT_POST, 'active');
        
         $util = new Util();
         //$emailTypeDAO = new EmailTypeDAO($db);
         //$emailDAO = new EmailDAO($db);
         
         //$emailTypes = $emailTypeDAO->getAllRows();
         
         
         
         
    
        ?>
     
<table border="1" cellpadding="5">
<tr>
<th>Firearm ID</th>
<th>Name</th>
<th>Caliber</th>
<th>Serial Number</th>
<th>Manufacturer</th>
<th>Price</th>
<th>Delete</th>
<th>Update</th>
</tr>
<?php 
            $emails = $gunDAO->getAllRows(); 
            foreach ($emails as $value) 
                {echo '<tr><td>',$value->getidFirearms(),'</td><td>',$value->getname(),'</td><td>',$value->getcaliber(),'</td><td>', $value->getsernum(),'</td>';
                 echo  '<td>', $value->getmanuf(),'</td><td>', $value->getprice(),'</td>         <td> <a href=page6.php?idFirearms=',$value->getidFirearms(),'>Delete</a> </td>    <td> <a href=page5.php?idFirearms=',$value->getidFirearms(),'>Update</a> </td> </tr>' ;} ?>
</table>