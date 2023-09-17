<?php

$requestPayload = file_get_contents("php://input");

echo $requestPayload;

$payloadDecode = json_decode($requestPayload);

//Note this needs sanitation for missing or invalid format fields
$payloadOrderId = $payloadDecode->orderId;
$payloadOrderType = $payloadDecode->orderType;
$payloadDestination = $payloadDecode->destination;
$PayloadOrderTime = $payloadDecode->orderTime;

$uploadTimeRaw=time();
$uploadTime = date("Y-m-d h:i:s",$uploadTimeRaw);
echo $uploadTime;

$myfile = fopen("/var/www/html/digitalOMySQLCreds.txt", "r") or die("Unable to open file!");
//$wmsadmin_creds = fread($myfile,filesize("/var/www/html/digitalOMySQLCreds.txt"));
$wms_creds = fgets($myfile);
fclose($myfile);

$wms_creds = substr($wms_creds, 0, -1);

$servername = "localhost";
$username = "wmsadmin";

// Create connection
$conn = new mysqli($servername, $username, $wms_creds);

// // Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
} 
echo "<p>Connected successfully<p>";

$insert_sql = "INSERT INTO wmssandbox_digitalO.orders (sys_order_id, order_type, order_status, destination_facility, order_time, order_created_dttm) VALUES ($payloadOrderId, ' $payloadOrderType', 'Created', $payloadDestination, '$uploadTime', sysdate())";
echo $insert_sql;

if ($conn->query($insert_sql) === TRUE) {
  echo "Record inserted successfully";
} else {
  echo "error inserting";
  //echo "Error inserting record: " . $conn->error;
}

$conn->close();
?>