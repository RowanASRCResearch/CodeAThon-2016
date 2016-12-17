<?php
/**
 * Created by PhpStorm.
 * User: eliakah
 * Date: 7/11/2016
 * Time: 1:47 PM
 */
function pull($flag , $party_id)
{
    include 'functions.php';
    $dbcnx = db_connect_sel();


    if ($flag === 'f') {//asking for flags
        $sql = 'SELECT * FROM flag WHERE  party="' . $party_id . '";';
        $result = $dbcnx->query($sql);

        return $result;

    }

    if ($flag === 'p') {//asking for points return list of vessels
        $sql = 'SELECT * FROM vessel WHERE  party="' . $party_id . '";';
        $result = $dbcnx->query($sql);

        echo $sql;
        return $result;

    }


}

?>