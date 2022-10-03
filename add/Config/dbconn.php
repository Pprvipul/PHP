<?php
$serverName="LPGTRBILCOR82\BROTHER1"; //serverName\instanceName
$connectionInfo = array( "Database"=>"VIPUL_DB", "UID"=>"sa", "PWD"=>"sql@2022");
$biconn = sqlsrv_connect( $serverName, $connectionInfo);

if( $biconn ) {
    
    
}else{
     echo "Connection could not be established.<br />";
     die( print_r( sqlsrv_errors(), true));
}



?>