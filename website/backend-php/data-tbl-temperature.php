<?php
require 'db-connect.php';
?>

<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">

<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>

<table id="data-tbl-temperature" class="hover stripe">
    <thead>
        <tr>
            <th scope="col">Timestamp</th>
            <th scope="col">Temperature</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $query_select_temp_dtbl = "SELECT `time_stamp`, `value_temp` FROM `tbl_temp`";
        $result_select_temp_dtbl = mysqli_query($conn, $query_select_temp_dtbl);

        while ($fetch_row_temp_dtbl = mysqli_fetch_assoc($result_select_temp_dtbl)) {
            echo (
                '<tr>
                <td>' . $fetch_row_temp_dtbl['time_stamp'] . '</td>
                <td>' . $fetch_row_temp_dtbl['value_temp'] . '</td>
                </tr>'
            );
        }
        ?>
    </tbody>
</table>

<script>
    new DataTable('#data-tbl-temperature', {
        autoWidth: false,
        ordering: true,
        searching: false,
        lengthChange: false,
        responsive: true,
        order: [
            [0, 'desc'],
            [1, 'desc'],
        ]
    });
</script>