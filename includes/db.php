<?php

include "dbConfig.php";

foreach($db as $key  =>  $value)
{
    if(!defined(strtoupper($key))){ define(strtoupper($key), $value); }
}

$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

?>