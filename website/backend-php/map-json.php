<?php
require 'db-connect.php';

$location_json = array();

$query_select_location = "SELECT `value_lat`, `value_lon` FROM `tbl_gps`";
$result_select_location = mysqli_query($conn, $query_select_location);

while ($fetch_row_location = mysqli_fetch_assoc($result_select_location)) {
    array_push($location_json, $fetch_row_location);
}

echo json_encode($location_json);
?>