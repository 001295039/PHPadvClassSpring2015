<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of emailTypeDB
 *
 * This is a class save and display the email type
 * 
 * @author 001295039
 */
class emailTypeDB {
    
    function Save2DB($emailType)
    {
        //save to to database.
    $dbConfig = array(
        "DB_DNS"=>'mysql:host=localhost;port=3306;dbname=PHPadvClassSpring2015',
        "DB_USER"=>'root',
        "DB_PASSWORD"=>''
        );
            
    
    $pdo = new DB($dbConfig);
    $db = $pdo->getDB();
    $stmt = $db->prepare("INSERT INTO emailtype SET emailtype = :emailtype");          
    $values = array(":emailtype"=>$emailType);

    
    if ( $stmt->execute($values) && $stmt->rowCount() > 0 ) 
        {echo 'Email Added';}
    }//End save2db()
    
    
    function DispFroDB()
    {
        $dbConfig = array(
        "DB_DNS" => 'mysql:host=localhost;port=3306;dbname=PHPadvClassSpring2015',
        "DB_USER" => 'root', 
        "DB_PASSWORD" => '');

    $pdo = new DB($dbConfig);
    $db = $pdo->getDB();
    $stmt = $db->prepare("SELECT * FROM emailtype where 1 = 1");

    if ($stmt->execute() && $stmt->rowCount() > 0) 
    {
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($results as $value) 
        {if ($value['active'] == 1)
            {echo '<p><strong>', $value['emailtype'], '</strong></p>';}
        else
            echo '<p>', $value['emailtype'], '</p>';}
    } 
    else 
    {echo '<p>No Data</p>';} 
    }//End dispfroDB
    
    
    
    
    
    
    
}
