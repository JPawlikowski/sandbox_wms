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

th {
    text-align: left;
}
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
//echo "<p>Connected successfully<p>";

$sql = "SELECT order_id, tc_order_line_id, status, item_name, pack_qty, ordered_qty, allocated_qty, packed_qty, last_updated_dttm, created_dttm FROM wmssandbox_digitalO.order_lines where order_id = $q order by created_dttm desc";
//echo $sql;
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  echo "<table>
  <tr>
  <th>Order id</th>
  <th>Order Line Id</th>
  <th>Status</th>
  <th>Item Name</th>
  <th>Pack Qty</th>
  <th>Ordered Qty</th>
  <th>Allocated Qty</th>
  <th>Packed Qty</th>
  <th>Last Updated Dttm</th>
  <th>Created Dttm</th>
  </tr>";

  while($order_row = $result->fetch_assoc()) {
  echo "<tr>";
  echo "<td>" . $order_row['order_id'] . "</td>";
  echo "<td>" . $order_row['tc_order_line_id'] . "</td>";
  echo "<td>" . $order_row['status'] . "</td>";
  echo "<td>" . $order_row['item_name'] . "</td>";
  echo "<td>" . $order_row['pack_qty'] . "</td>";
  echo "<td>" . $order_row['ordered_qty'] . "</td>";
  echo "<td>" . $order_row['allocated_qty'] . "</td>";
  echo "<td>" . $order_row['packed_qty'] . "</td>";
  echo "<td>" . $order_row['last_updated_dttm'] . "</td>";
  echo "<td>" . $order_row['created_dttm'] . "</td>";
  echo "</tr>";
  }
  echo "</table>";
  
} else {
  echo "0 orders results for this order";
}
$conn->close();
?>
</body>
</html>