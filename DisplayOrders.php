
<html>
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
  echo "<table>
  <tr>
  <th>sys_order_id</th>
  <th>order_type</th>
  <th>order_status</th>
  <th>destination_facility</th>
  <th>order_time</th>
  </tr>";

  while($order_row = $result->fetch_assoc()) {
  echo "<tr>";
  echo "<td>" . $order_row['sys_order_id'] . "</td>";
  echo "<td>" . $order_row['order_type'] . "</td>";
  echo "<td>" . $order_row['order_status'] . "</td>";
  echo "<td>" . $order_row['destination_facility'] . "</td>";
  echo "<td>" . $order_row['order_time'] . "</td>";
  echo "</tr>";
  }
  echo "</table>";
  
} else {
  echo "0 orders results";
}
$conn->close();

?>
<html>