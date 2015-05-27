<?php 
include './bootstrap.php'; 
?>

<p>Read Page</p>

<?php
                
    $dbConfig = array(
    "DB_DNS"=>'mysql:host=localhost;port=3306;dbname=PHPadvClassSpring2015',
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
<th>Email</th>
<th>Email Type</th>
<th>Last updated</th>
<th>Logged</th>
<th>Active</th>
<th>Delete</th>
<th>Update</th>
</tr>
<?php 
            $emails = $gunDAO->getAllRows(); 
            foreach ($emails as $value) 
                {echo '<tr><td>',$value->getEmail(),'</td><td>',$value->getEmailtype(),'</td><td>',date("F j, Y g:i(s) a", strtotime($value->getLastupdated())),'</td><td>',date("F j, Y g:i(s) a", strtotime($value->getLogged())),'</td>';
                 echo  '<td>', ( $value->getActive() == 1 ? 'Yes' : 'No') ,'</td>     <td> <a href=DelEmail.php?emailid=',$value->getEmailid(),'>Delete</a> </td>           <td> <a href=UpdateEmail.php?emailid=',$value->getEmailid(),'>Update</a> </td> </tr>' ;} ?>
</table>