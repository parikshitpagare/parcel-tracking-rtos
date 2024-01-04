<?php
require 'db-connect.php';

$query_select_temp = "SELECT * FROM `tbl_temp`";
$result_select_temp = mysqli_query($conn, $query_select_temp);

while ($fetch_row_temp = mysqli_fetch_assoc($result_select_temp)) {
    $temp = $fetch_row_temp['value_temp'];
    $temp_time = $fetch_row_temp['time_stamp'];
}

if ($temp >= 25) {
    echo ('<h3><span class="badge rounded-pill text-bg-danger fs-4 fw-normal mt-3 text-wrap text-white">Critical Temperature</span></h3>');
}
if ($temp < 25) {
    echo ('<h3><span class="badge rounded-pill text-bg-success fs-4 fw-normal mt-3 text-wrap">Ambient Temperature</span></h3>');
}
?>

<span class=" small text-muted text-wrap fw-semibold"><?php echo ("$temp_time") ?></span>