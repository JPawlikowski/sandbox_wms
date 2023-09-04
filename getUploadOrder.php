<!DOCTYPE html>
<html>
<head>
<style>
table {
  width: 100%;
  border-collapse: collapse;
}

table, td, th {
  border: 1px solid black;
  padding: 5px;
}

th {text-align: left;}
</style>
</head>
<body>

<?php
$q = intval($_GET['q']);

$myfile = fopen("/var/www/html/digitalOMySQLCreds.txt", "r") or die("Unable to open file!");
//$wmsadmin_creds = fread($myfile,filesize("/var/www/html/digitalOMySQLCreds.txt"));
$wms_creds = fgets($myfile);
fclose($myfile);

$wms_creds = substr($wms_creds, 0, -1);

$servername = "localhost";
$username = "wmsadmin";

// Create connection
$conn = new mysqli($servername, $username, $wms_creds);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
} 
echo "<p>Connected successfully<p>";

$insert_sql = "INSERT INTO wmssandbox_digitalO.orders (sys_order_id, order_type, order_status, destination_facility) VALUES (876543,'TEST','Created','1234')";

if ($conn->query($insert_sql) === TRUE) {
  echo "Record inserted successfully";
} else {
  echo "error inserting";
  //echo "Error inserting record: " . $conn->error;
}

$conn->close();
?>
</body>
</html>