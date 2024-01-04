<?php
require 'db-connect.php';

$temp_json = array();

$query_select_temp = "SELECT `time_stamp`, `value_temp` FROM `tbl_temp`";
$result_select_temp = mysqli_query($conn, $query_select_temp);

while ($fetch_row_temp = mysqli_fetch_assoc($result_select_temp)) {
    array_push($temp_json, $fetch_row_temp);
}

echo json_encode($temp_json);
?>