<?php
/**
 * Created by PhpStorm.
 * User: eliakah
 * Date: 7/11/2016
 * Time: 4:23 PM
 */
require_once 'functions.php';
$connection = db_connect_sel();
var_dump($connection->host_info);
?>