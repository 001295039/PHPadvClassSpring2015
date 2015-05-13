<?php namespace App\models\services; ?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Lab 03</title>
    </head>
    <body>
        
        <?php

         if ( $scope->util->isPostRequest() ) {
             
             if ( isset($scope->view['errors']) ) {
                print_r($scope->view['errors']);
             }
             
             if ( isset($scope->view['saved']) && $scope->view['saved'] ) {
                  echo 'Email Added';
             }
             
             if ( isset($scope->view['deleted']) && $scope->view['deleted'] ) {
                  echo 'Email deleted';
             }
             
         }
        
         $email = $scope->view['model']->getEmail();
         $active = $scope->view['model']->getActive();
         $emailTypeid = $scope->view['model']->getEmailTypeid();
        ?>
        
        
         <h3>Add Email</h3>
        <form action="#" method="post">
            <label>Email:</label> 
            <input type="text" name="Email" value="<?php echo $email; ?>" placeholder="" />
            <input type="number" max="1" min="0" name="Active" value="<?php echo $active; ?>" />
            <input type="hidden" name="action" value="create" />
            <input type="submit" value="Submit" />
        
                  <br /><br />
            <label>Email Type:</label>
            <select name="emailtypeid">
            <?php 
                foreach ($scope->view['EmailTypes'] as $value) {
                    if ( $value->getemailtypeid() == $emailTypeid ) {
                        echo '<option value="',$value->getemailtypeid(),'" selected="selected">',$value->getemailtype(),'</option>';  
                    } else {
                        echo '<option value="',$value->getemailtypeid(),'">',$value->getemailtype(),'</option>';
                    }
                }
            ?>
            </select>
            
             <br /><br />
            
         </form>
        <form action="#" method="post">
            <input type="hidden" name="action" value="add" />
            
        </form>
         <?php
         
        
          if ( count($scope->view['Emails']) <= 0 ) {
            echo '<p>No Data</p>';
        } else {
            
            
             echo '<table border="1" cellpadding="5"><tr><th>Email</th><th>Active</th><th>Email Type</th><th>Edit</th><th>Delete</th></tr>';
             foreach ($scope->view['Emails'] as $value) {
                echo '<tr>';
                echo '<td>', $value->getEmail(),'</td>';
                echo '<td>', ( $value->getActive() == 1 ? 'Yes' : 'No') ,'</td>';
                echo '<td>', $value->getEmailType() ,'</td>';
                echo '<td><form action="#" method="post"><input type="hidden"  name="emailid" value="',$value->getEmailid(),'" /><input type="hidden" name="action" value="edit" /><input type="submit" value="EDIT" /> </form></td>';
                echo '<td><form action="#" method="post"><input type="hidden"  name="emailid" value="',$value->getEmailid(),'" /><input type="hidden" name="action" value="delete" /><input type="submit" value="DELETE" /> </form></td>';
                echo '</tr>' ;
            }
            echo '</table>';
            
        }
          
         
        ?>
    </form>
         <h3>
             <a href="index">Index</a></h3>
    </body>
</html>