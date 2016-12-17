<?php
/**
 * Created by PhpStorm.
 * User: eliakah
 * Date: 7/11/2016
 * Time: 1:47 PM
 */
function run()
{
    //include 'functions.php';
    $dbcnx = db_connect_sel();


    $sql = 'SELECT * FROM `point` WHERE vessel = "91";';
    //echo $sql;
    $result = $dbcnx->query($sql);
    while($row = $result->fetch_assoc()) {
        //echo $row['lat'];
    }
    return $result;
}



?>