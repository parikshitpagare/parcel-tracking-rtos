<?php
require 'db-connect.php';
?>

<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">

<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>

<table id="data-tbl-vibration" class="hover stripe">
    <thead>
        <tr>
            <th scope="col">Timestamp</th>
            <th scope="col">X-axis</th>
            <th scope="col">Y-axis</th>
            <th scope="col">Z-axis</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $query_select_vib_dtbl = "SELECT  `time_stamp`, `value_xvib`, `value_yvib`, `value_zvib` FROM `tbl_vib`";
        $result_select_vib_dtbl = mysqli_query($conn, $query_select_vib_dtbl);

        while ($fetch_row_vib_dtbl = mysqli_fetch_assoc($result_select_vib_dtbl)) {
            echo (
                '<tr>
                <td>' . $fetch_row_vib_dtbl['time_stamp'] . '</td>
                <td>' . $fetch_row_vib_dtbl['value_xvib'] . '</td>
                <td>' . $fetch_row_vib_dtbl['value_yvib'] . '</td>
                <td>' . $fetch_row_vib_dtbl['value_zvib'] . '</td>
                </tr>'
            );
        }
        ?>
    </tbody>
</table>

<script>
    new DataTable('#data-tbl-vibration', {
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