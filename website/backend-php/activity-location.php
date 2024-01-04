<?php
require 'db-connect.php';

$query_select_gps = "SELECT * FROM `tbl_gps`";
$result_select_gps = mysqli_query($conn, $query_select_gps);

while ($fetch_row_gps = mysqli_fetch_assoc($result_select_gps)) {
    $lat = $fetch_row_gps['value_lat'];
    $lon = $fetch_row_gps['value_lon'];
    $gps_time = $fetch_row_gps['time_stamp'];
}
?>

<h3><span class="badge rounded-pill text-bg-primary mt-3 fs-4 fw-normal text-wrap"><?php echo ("$lat, $lon") ?></span></h3>
<span class=" small text-muted text-wrap fw-semibold"><?php echo ("$gps_time") ?></span>