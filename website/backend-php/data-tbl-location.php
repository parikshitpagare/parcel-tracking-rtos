<?php
require 'db-connect.php';
?>

<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">

<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>

<table id="data-tbl-location" class="hover stripe">
    <thead>
        <tr>
            <th scope="col">Timestamp</th>
            <th scope="col">Latitude</th>
            <th scope="col">Longitude</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $query_select_gps_dtbl = "SELECT `time_stamp`, `value_lat`, `value_lon` FROM `tbl_gps`";
        $result_select_gps_dtbl = mysqli_query($conn, $query_select_gps_dtbl);

        while ($fetch_row_gps_dtbl = mysqli_fetch_assoc($result_select_gps_dtbl)) {
            echo (
                '<tr>
                <td>' . $fetch_row_gps_dtbl['time_stamp'] . '</td>
                <td>' . $fetch_row_gps_dtbl['value_lat'] . '</td>
                <td>' . $fetch_row_gps_dtbl['value_lon'] . '</td>
                </tr>'
            );
        }
        ?>
    </tbody>
</table>

<script>
    table = new DataTable('#data-tbl-location', {
        autoWidth: false,
        ordering: true,
        searching: false,
        lengthChange: false,
        responsive: true,
        order: [
            [0, 'desc'],
        ]
    });
</script>