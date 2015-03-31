<?php include './bootstrap.php'; ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        
        
        <?php
        
$util = new Util();
$validator = new Validator();

$phoneType = filter_input(INPUT_POST, 'phonetype');

$errors = array();

if ( $util->isPostRequest() ) {

    if ( !$validator->phoneTypeIsValid($phoneType) ) {
        $errors[] = 'Phone type is not valid';
    }
}

if ( count($errors) > 0 ) {
    foreach ($errors as $value) {
        echo '<p>',$value,'</p>';
    }
} else {
    
    //save to to database.
    
}
        
        
        
       
        ?>
        
         <h3>Add phone type</h3>
        <form action="#" method="post">
            <label>Phone Type:</label> 
            <input type="text" name="phonetype" value="<?php echo $phoneType; ?>" placeholder="" />
            <input type="submit" value="Submit" />
        </form>
    </body>
</html>
