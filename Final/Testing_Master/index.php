<?php
$page_content = 'innertext\index.php';
include('content\master.php');


if(isset($_POST['pg3_Create'])){
  $page_content = 'innertext\page3.php';   
}


?>