<?php
/**
 * Created by PhpStorm.
 * User: eliakah
 * Date: 7/11/2016
 * Time: 1:47 PM
 */
function pullPoint($vessel)
{
    include 'functions.php';
    $dbcnx = db_connect_sel();


        $sql = 'SELECT * FROM point WHERE  vessel="' . $vessel . '";';
        $result = $dbcnx->query($sql);

        return $result;


}

?>