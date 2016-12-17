<?php
/**
 * Created by PhpStorm.
 * User: eliakah
 * Date: 7/11/2016
 * Time: 1:47 PM
 */

$data = json_decode(file_get_contents("php://input"), true);
include 'functions.php';
$dbcnx = db_connect_sel();
include 'get_p_id.php';

if ($_GET['flag'] === 'f'){//when a point is passed
    $vessel =  $data['vessel'];
    $lat = $data['lat'];
    $lon = $data['lon'];
    $type = $data['type'];
    $desc = $data['desc'];

    // $partyID = getParty($vessel);
    // echo "party id = ".$partyID;

    //echo ''.$lat.$lon.$type.$desc;
     // echo 'mmsi = ' . $vessel;

      $partyID = getParty($vessel, $dbcnx);
     echo "party id = ".$partyID;

    $sql = "INSERT INTO flag (vessel, party, lat, lon,type, description)" .
        "VALUES ('".$vessel."','".$partyID."','".$lat."','".$lon."','".$type."','".$desc."');";

}

if($_GET['flag'] === 'p'){ //when a point is passed
    $vessel =  $data['vessel'];
    $lat = $data['lat'];
    $lon = $data['lon'];


    $sql = "INSERT INTO point (vessel, lat, lng)" .
        "VALUES ('".$vessel."','".$lat."','".$lon."');";


}

echo $sql."<br>";

    if ($dbcnx->query($sql) === TRUE) {
        echo "success";
    } else {
        echo "Error: " . $sql . "<br>" . $dbcnx->error;
    }

    $dbcnx->close();


?>