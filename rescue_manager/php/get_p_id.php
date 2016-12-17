<?php
/**
 * Created by PhpStorm.
 * User: eliakah
 * Date: 12/16/2016
 * Time: 8:32 PM
 */

function getParty($vessel, $dbcnx){
$p_id = "";
$sql2 = $query = 'SELECT * FROM vessel WHERE  id="' . $vessel . '";';

echo ''.$vessel;

//echo ''.$sql2;

    $result = $dbcnx->query($sql2);

    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            $p_id = $row['party'];
               }
        return $p_id;
    } else {
        echo "Error: No such Party exists";


    $dbcnx->close();
    exit(1);
    }

}



?>