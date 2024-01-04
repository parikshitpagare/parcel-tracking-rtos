<?php
require 'db-connect.php';

/* HTTP GET request from ESP32 */

if (isset($_GET['lat']) || isset($_GET['lon']) || isset($_GET['temp']) || isset($_GET['x']) || isset($_GET['y']) || isset($_GET['z'])) {
    $lat = $_GET['lat'];
    $lon = $_GET['lon'];
    $temp = $_GET['temp'];
    $xvib = $_GET['x'];
    $yvib = $_GET['y'];
    $zvib = $_GET['z'];
    
    /* Location */
    $query_insert_gps = "INSERT INTO `tbl_gps` (`value_lat`, `value_lon`) VALUES ('$lat', '$lon')";
    $result_insert_gps = mysqli_query($conn, $query_insert_gps);

    /* Temperature */
    $query_insert_temp = "INSERT INTO `tbl_temp` (`value_temp`) VALUES ('$temp')";
    $result_insert_temp = mysqli_query($conn, $query_insert_temp);

    /* Vibration */
    $query_insert_vib = "INSERT INTO `tbl_vib` (`value_xvib`, `value_yvib`, `value_zvib`) VALUES ('$xvib', '$yvib', '$zvib')";
    $result_insert_vib = mysqli_query($conn, $query_insert_vib);
}
