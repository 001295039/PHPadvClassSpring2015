
<body id="body">
<div id="header"><?php include('header.php');?></div>
<div id="nav"><?php include('nav.php');?></div>
<div id="section"><?php include($page_content);?></div>
<div id="footer"><?php include('footer.php');?></div>
</body>




<style>
#body{background-color:#e6e6e6;}

#header {
    background-color:black;
    color:white;
    text-align:center;
    padding:5px;
}
#nav {
    line-height:30px;
    background-color:#eeeeee;
    height:300px;
    width:100px;
    float:left;
    padding:5px; 
}
#section {
    width:350px;
    float:left;
    padding:10px; 
}
#footer {
    background-color:black;
    color:white;
    clear:both;
    text-align:center;
    padding:5px; 
}
</style>