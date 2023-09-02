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

$sql = "SELECT item_desc, pack_qty, on_hand_qty, allocated_qty, mod_dttm FROM wmssandbox_digitalO.inventory";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  echo "<table>
  <tr>
  <th>item_desc</th>
  <th>pack_qty</th>
  <th>on_hand_qty</th>
  <th>allocated_qty</th>
  <th>mod_dttm</th>
  </tr>";

  while($invn_row = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td>" . $invn_row['item_desc'] . "</td>";
    echo "<td>" . $invn_row['pack_qty'] . "</td>";
    echo "<td>" . $invn_row['on_hand_qty'] . "</td>";
    echo "<td>" . $invn_row['allocated_qty'] . "</td>";
    echo "<td>" . $invn_row['mod_dttm'] . "</td>";
    echo "</tr>";
  }
  echo "</table>";
  
} else {
  echo "0 orders results";
}
$conn->close();
?>
</body>
</html>