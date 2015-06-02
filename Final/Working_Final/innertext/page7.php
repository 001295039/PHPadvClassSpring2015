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
            
            if ( $util->isPostRequest() ) {
                $dbConfig = array(
    "DB_DNS"=>'mysql:host=localhost;port=3306;dbname=FirearmsDB',
    "DB_USER"=>'root',
    "DB_PASSWORD"=>''
        );
        
    
        $pdo = new DB($dbConfig);
        $db = $pdo->getDB();

                $model = new SignupModel();
                $signupDao = new SignupDAO($db, $model);            
                $model->map(filter_input_array(INPUT_POST));
                                
                if ( $signupDao->create($model) ) {
                    echo '<h2>Signup complete</h2>';
                } else {
                    echo '<h2>Signup Failed</h2>';
                }
            }
           
            
        ?>
        
        <h1>Signup</h1>
        <form action="#" method="POST">
            
            username: <input type="text" name="name" value="" /> <br />
            Password : <input type="password" name="level" value="" /> <br /> 
            <br />
            <input type="submit" value="Signup" />
            
        </form>
    </body>
</html>