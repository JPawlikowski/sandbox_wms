
<html>
<?php

echo "<p>Sample digital O WMS Sandbox connections</p>";

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

$sql = "SELECT sys_order_id, order_type, order_status FROM wmssandbox_digitalO.orders";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    echo "sys_order_id: " . $row["sys_order_id"]. " - type: " . $row["order_type"]. " - status" . $row["order_status"]. "<br>";
  }
} else {
  echo "0 results";
}
$conn->close();

?>
<html>//