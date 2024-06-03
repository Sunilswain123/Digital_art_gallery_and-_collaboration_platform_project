<?php 

$HOSTNAME="127.0.0.1:8888";
$USERNAME="root";
$PASSWORD="";
$DBNAME="crud";
try{
    $conn=new mysqli("$HOSTNAME","$USERNAME","$PASSWORD","$DBNAME");
    if($conn->connect_error){
        echo "connction error".$conn->connect_error;
    }
}
catch(Exception $e)
{
    echo "check credentials <br>";
    echo $e->getMessage()."at line".$e->getLine();
}
?>