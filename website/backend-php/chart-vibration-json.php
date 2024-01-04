<?php
require 'db-connect.php';

$vib_json = array();

$query_select_vib = "SELECT `time_stamp`, `value_xvib`, `value_yvib`, `value_zvib` FROM `tbl_vib`";
$result_select_vib = mysqli_query($conn, $query_select_vib);

while ($fetch_row_vib = mysqli_fetch_assoc($result_select_vib)) {
    array_push($vib_json, $fetch_row_vib);
}

echo json_encode($vib_json);
?>