<?php
require 'db-connect.php';

$query_select_vib = "SELECT * FROM `tbl_vib`";
$result_select_vib = mysqli_query($conn, $query_select_vib);

while ($fetch_row_vib = mysqli_fetch_assoc($result_select_vib)) {
    $xvib = $fetch_row_vib['value_xvib'];
    $yvib = $fetch_row_vib['value_yvib'];
    $zvib = $fetch_row_vib['value_zvib'];
    $vib_time = $fetch_row_vib['time_stamp'];
}

if ($xvib >= 30 || $yvib >= 30 || $zvib >= 30) {
    echo ('<h3><span class="badge rounded-pill text-bg-danger fs-4 fw-normal mt-3 text-wrap text-white">High Vibration</span></h3>');
}
else {
    echo ('<h3><span class="badge rounded-pill text-bg-success fs-4 fw-normal mt-3 text-wrap">Low Vibration</span></h3>');
}
?>
<span class=" small text-muted text-wrap fw-semibold"><?php echo ("$vib_time") ?></span>
