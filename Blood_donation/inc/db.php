<?php 
    /*$db['db_host']="sql201.epizy.com";
    $db['db_user']="epiz_22901474";
    $db['db_pass']="4JzZz77k6P";
    $db['db_name']="epiz_22901474_cms";*/

    $db['db_host']="localhost";
    $db['db_user']="root";
    $db['db_pass']="";
    $db['db_name']="cms";
    foreach($db as $key =>$value)
    {
        define(strtoupper($key),$value);
    }
    $con=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
    
?>