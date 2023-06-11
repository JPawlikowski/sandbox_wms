<html>
<p id='sampleId'>Sample workspace</p>

<head>

<!-- <script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"> -->
<script>
    function sample_update_inventory() {
        document.getElementById('sampleId').innerHTML = 'TESTJS';

         JQuery.ajax({
         type: 'POST',
         url: 'sample.php',
         data: { item_name: '123123123', new_onhand: 11 },
         success: function(response) {

         }
     });

        // jQuery.ajax({
        // type : 'POST',
        // dataType : 'json',
        // url : sample.php,
        // data : { 
        //     action: 'update_claim',
        //     claim: claim_id_test,
        //     status: new_status,
        //     comment: decline_comment
        //  // add your parameters herea
        // },
        //     success: function( response ) {
        //     // Returns success json data
        //     console.log( response );
        // },
        //     complete: function () {
        //     console.log ( response );
        // }
        // });
    }
    
</script>

<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}
</style>

<?php

$myfile = fopen("/Applications/XAMPP/xamppfiles/htdocs/localhostcreds.txt", "r") or die("Unable to open file!");
$wms_creds = fgets($myfile);
fclose($myfile);

$wms_creds = substr($wms_creds, 0, -1);;

$wms_user = 'wms_admin';

$con = mysqli_connect('localhost', $wms_user, $wms_creds);
if (!$con) {
  die('Could not connect: ' . mysqli_error($con));
}


mysqli_select_db($con, "wms_test");
$order_sql="SELECT sys_order_id, order_type, order_status, destination_facility, order_time FROM orders order by order_time desc";
$order_result = mysqli_query($con,$order_sql);

echo "<table>
<tr>
<th>sys_order_id</th>
<th>order_type</th>
<th>order_status</th>
<th>destination_facility</th>
<th>order_time</th>
</tr>";
while($order_row = mysqli_fetch_array($order_result)) {
  echo "<tr>";
  echo "<td>" . $order_row['sys_order_id'] . "</td>";
  echo "<td>" . $order_row['order_type'] . "</td>";
  echo "<td>" . $order_row['order_status'] . "</td>";
  echo "<td>" . $order_row['destination_facility'] . "</td>";
  echo "<td>" . $order_row['order_time'] . "</td>";
  echo "</tr>";
}
echo "</table>";

echo "<p>";
echo "</p>";

mysqli_select_db($con,"wms_test");
$item_sql="SELECT item_name, item_desc, width, length, height, weight, category, std_pack_qty, status, last_updated_dttm, created_dttm, updated_by FROM items order by created_dttm desc";
$item_result = mysqli_query($con,$item_sql);

echo "<table>
<tr>
<th>item_name</th>
<th>item_desc</th>
<th>width</th>
<th>length</th>
<th>height</th>
<th>weight</th>
<th>category</th>
<th>std_pack_qty</th>
<th>status</th>
<th>last_updated_dttm</th>
<th>created_dttm</th>
<th>updated_by</th>
</tr>";
while($item_row = mysqli_fetch_array($item_result)) {
  echo "<tr>";
  echo "<td>" . $item_row['item_name'] . "</td>";
  echo "<td>" . $item_row['item_desc'] . "</td>";
  echo "<td>" . $item_row['width'] . "</td>";
  echo "<td>" . $item_row['length'] . "</td>";
  echo "<td>" . $item_row['height'] . "</td>";
  echo "<td>" . $item_row['weight'] . "</td>";
  echo "<td>" . $item_row['category'] . "</td>";
  echo "<td>" . $item_row['std_pack_qty'] . "</td>";
  echo "<td>" . $item_row['status'] . "</td>";
  echo "<td>" . $item_row['last_updated_dttm'] . "</td>";
  echo "<td>" . $item_row['created_dttm'] . "</td>";
  echo "<td>" . $item_row['updated_by'] . "</td>";
  echo "</tr>";
}
echo "</table>";

mysqli_select_db($con,"wms_test");
$item_sql="SELECT item_name, location, on_hand, to_be_filled, allocated, last_updated_dttm, created_dttm, last_updated_by FROM inventory order by created_dttm desc";
$item_result = mysqli_query($con,$item_sql);

echo "<table>
<tr>
<th>item_name</th>
<th>location</th>
<th>on_hand</th>
<th>to_be_filled</th>
<th>allocated</th>
<th>last_updated_dttm</th>
<th>created_dttm</th>
<th>last_updated_by</th>
</tr>";
while($item_row = mysqli_fetch_array($item_result)) {
  echo "<tr>";
  echo "<td>" . $item_row['item_name'] . "</td>";
  echo "<td>" . $item_row['location'] . "</td>";
  echo "<td>" . $item_row['on_hand'] . "</td>";
  echo "<td>" . $item_row['to_be_filled'] . "</td>";
  echo "<td>" . $item_row['allocated'] . "</td>";
  echo "<td>" . $item_row['last_updated_dttm'] . "</td>";
  echo "<td>" . $item_row['created_dttm'] . "</td>";
  echo "<td>" . $item_row['last_updated_by'] . "</td>";
  echo "</tr>";
}
echo "</table>";

mysqli_close($con);
?>
</head>

<body>
<button type="button" onclick="sample_update_inventory()">invn update test</button>;
</body>

</html>