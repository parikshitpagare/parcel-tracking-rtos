<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
  header("location: login.php");
  exit;
}

require 'backend-php/db-credentials.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>FastDart Logistics</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />

  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />

  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">

  <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

  <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

  <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
</head>

<body style="background-color: #f8f9fa;">

  <!-- Start: Navigation bar-->
  <nav class="navbar sticky-top navbar-expand-lg bg-dark border-bottom border-body navbar-dark">
    <div class="container-lg">
      <a class="navbar-brand fs-3 fw-semibold" href="#">FastDart Track | <span class="fs-4 fw-normal">Dashboard</span></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <span class=" navbar-text fs-5 fw-semibold" style="color: white">Hello, <?php echo $_SESSION['username'] ?>! &nbsp; &nbsp;</span>
          <li class="nav-item">
            <a class="btn btn-outline-light fs-5 fw-semibold" href="logout.php" role="button">Logout</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <!-- End: Navigation bar end-->

  <div class="container-lg mb-3">
    <p class="fs-3 my-4 fw-semibold text-center text-muted">Activity Monitoring</p>
  </div>

  <!-- Start: Activity monitoring -->
  <div class="container-lg text-center">
    <div class="row row-cols-1 row-cols-md-3 mb-1 text-center">

      <!-- Location -->
      <div class="col">
        <div class="card mb-4 rounded-4 shadow border-light card-hover">
          <div class="card-body">
            <svg xmlns="http://www.w3.org/2000/svg" width="90" height="90" fill="#595c5f" class="bi bi-geo-alt-fill text-start mt-2 mb-3" viewBox="0 0 16 16">
              <path d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10zm0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6z" />
            </svg>
            <div id="activity-location">
              <?php
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
            </div>
          </div>
        </div>
      </div>

      <!-- Temperature -->
      <div class="col">
        <div class="card mb-4 rounded-4 shadow border-light">
          <div class="card-body">
            <svg xmlns="http://www.w3.org/2000/svg" width="90" height="90" fill="#595c5f" class="bi bi-thermometer-half mt-2 mb-3" viewBox="0 0 16 16">
              <path d="M9.5 12.5a1.5 1.5 0 1 1-2-1.415V6.5a.5.5 0 0 1 1 0v4.585a1.5 1.5 0 0 1 1 1.415z" />
              <path d="M5.5 2.5a2.5 2.5 0 0 1 5 0v7.55a3.5 3.5 0 1 1-5 0V2.5zM8 1a1.5 1.5 0 0 0-1.5 1.5v7.987l-.167.15a2.5 2.5 0 1 0 3.333 0l-.166-.15V2.5A1.5 1.5 0 0 0 8 1z" />
            </svg>
            <div id="activity-temperature">
              <?php
              $query_select_temp = "SELECT * FROM `tbl_temp`";
              $result_select_temp = mysqli_query($conn, $query_select_temp);

              while ($fetch_row_temp = mysqli_fetch_assoc($result_select_temp)) {
                $temp = $fetch_row_temp['value_temp'];
                $temp_time = $fetch_row_temp['time_stamp'];
              }

              if ($temp >= 30) {
                echo ('<h3><span class="badge rounded-pill text-bg-danger fs-4 fw-normal mt-3 text-wrap text-white">Critical Temperature</span></h3>');
              }
              if ($temp < 30) {
                echo ('<h3><span class="badge rounded-pill text-bg-success fs-4 fw-normal mt-3 text-wrap">Ambient Temperature</span></h3>');
              }
              ?>
              <span class=" small text-muted text-wrap fw-semibold"><?php echo ("$temp_time") ?></span>
            </div>
          </div>
        </div>
      </div>

      <!-- Vibration -->
      <div class="col">
        <div class="card mb-4 rounded-4 shadow border-light">
          <div class="card-body">
            <svg xmlns="http://www.w3.org/2000/svg" width="90" height="90" fill="#595c5f" class="bi bi-phone-vibrate mt-2 mb-3" viewBox="0 0 16 16">
              <path d="M10 3a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1h4zM6 2a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h4a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H6z" />
              <path d="M8 12a1 1 0 1 0 0-2 1 1 0 0 0 0 2zM1.599 4.058a.5.5 0 0 1 .208.676A6.967 6.967 0 0 0 1 8c0 1.18.292 2.292.807 3.266a.5.5 0 0 1-.884.468A7.968 7.968 0 0 1 0 8c0-1.347.334-2.619.923-3.734a.5.5 0 0 1 .676-.208zm12.802 0a.5.5 0 0 1 .676.208A7.967 7.967 0 0 1 16 8a7.967 7.967 0 0 1-.923 3.734.5.5 0 0 1-.884-.468A6.967 6.967 0 0 0 15 8c0-1.18-.292-2.292-.807-3.266a.5.5 0 0 1 .208-.676zM3.057 5.534a.5.5 0 0 1 .284.648A4.986 4.986 0 0 0 3 8c0 .642.12 1.255.34 1.818a.5.5 0 1 1-.93.364A5.986 5.986 0 0 1 2 8c0-.769.145-1.505.41-2.182a.5.5 0 0 1 .647-.284zm9.886 0a.5.5 0 0 1 .648.284C13.855 6.495 14 7.231 14 8c0 .769-.145 1.505-.41 2.182a.5.5 0 0 1-.93-.364C12.88 9.255 13 8.642 13 8c0-.642-.12-1.255-.34-1.818a.5.5 0 0 1 .283-.648z" />
            </svg>
            <div id="activity-vibration">
              <?php
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
              } else {
                echo ('<h3><span class="badge rounded-pill text-bg-success fs-4 fw-normal mt-3 text-wrap">Low Vibration</span></h3>');
              }
              ?>
              <span class=" small text-muted text-wrap fw-semibold"><?php echo ("$vib_time") ?></span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- End: Activity monitoring -->

  <div class="container-lg">
    <br>
    <br>
    <p class="fs-3 mb-4 fw-semibold text-center text-muted">Real Time Updates</p>
  </div>

  <!-- Start: Realtime charts -->
  <div class="container-lg text-center">
    <div class="row row-cols-1 row-cols-md-2 mb-1 text-center">

      <!-- Temperature chart -->
      <div class="col">
        <div class="card mb-4 shadow rounded-4 border-light">
          <div class="card-body">
            <div class="chart-container" style="position: relative; height:50vh;">
              <canvas id="tempChart"></canvas>
            </div>
          </div>
        </div>
      </div>

      <!-- Vibration chart -->
      <div class="col">
        <div class="card mb-4 rounded-4 shadow border-light">
          <div class="card-body">
            <div class="chart-container" style="position: relative; height:50vh;">
              <canvas id="vibChart"></canvas>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- End: Realtime charts -->

  <!-- Map -->
  <div class="container-lg text-center">
    <div class="row mb-1 text-center">
      <div class="col-12">
        <div class="card mb-4 shadow rounded-4 border-0">
          <div class="card-body p-0">
            <div id="gpsMap" class="rounded-4" style="position: relative; height:40vh;">
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="container-lg">
    <br>
    <br>
    <p class="fs-3 mb-4 mt-1 fw-semibold text-center text-muted">Previous Data</p>
  </div>

  <!-- Start: Data tables -->
  <div class="container-lg" style="background-color: #ffffff;">
    <div class="row shadow rounded-4 border-light p-3">

      <!-- Start: Buttons -->
      <ul class="nav nav-pills justify-content-center my-3" id="pills-tab" role="tablist">
        <li class="nav-item" role="presentation">
          <button class="nav-link active fs-4 fw-normal" id="pills-location-tab" data-bs-toggle="pill" data-bs-target="#pills-location" type="button" role="tab" aria-controls="pills-location" aria-selected="true">Location</button>
        </li>

        <li class="nav-item" role="presentation">
          <button class="nav-link fs-4 fw-normal" id="pills-temperature-tab" data-bs-toggle="pill" data-bs-target="#pills-temperature" type="button" role="tab" aria-controls="pills-temperature" aria-selected="false">Temperature</button>
        </li>

        <li class="nav-item" role="presentation">
          <button class="nav-link fs-4 fw-normal" id="pills-vibration-tab" data-bs-toggle="pill" data-bs-target="#pills-vibration" type="button" role="tab" aria-controls="pills-vibration" aria-selected="false">Vibration</button>
        </li>
      </ul>
      <!-- End: Buttons -->

      <!-- Start: Content -->
      <div class="tab-content" id="pills-tabContent">

        <!-- DataTable refresh button -->
        <button id="btn-refresh" type="button" class="btn btn-outline-primary btn-sm my-2">Refresh Data</button>

        <!-- Location -->
        <div class="tab-pane fade show active mt-3" id="pills-location" role="tabpanel" aria-labelledby="pills-location-tab">
          <div id="datatable-location">
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
          </div>
        </div>

        <!-- Temperature -->
        <div class="tab-pane fade mt-3" id="pills-temperature" role="tabpanel" aria-labelledby="pills-temperature-tab">
          <div id="datatable-temperature">
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
          </div>
        </div>

        <!-- Vibration -->
        <div class="tab-pane fade mt-3" id="pills-vibration" role="tabpanel" aria-labelledby="pills-vibration-tab">
          <div id="datatable-vibration">
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
                $query_select_vib_dtbl = "SELECT `time_stamp`, `value_xvib`, `value_yvib`, `value_zvib` FROM `tbl_vib`";
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
          </div>
        </div>
        <!-- End: Content -->
      </div>
    </div>
  </div>
  <!-- End: Data tables -->

  <div class="container my-5">
    <footer>
      <p class=" small my-4 text-muted">Copyright</p>
    </footer>
  </div>

  <!-- Start: DataTables jquery -->
  <script>
    /* Location */
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

    /* Temperature */
    table = new DataTable('#data-tbl-temperature', {
      autoWidth: false,
      ordering: true,
      searching: false,
      lengthChange: false,
      responsive: true,
      order: [
        [0, 'desc'],
      ]
    });

    /* Vibration */
    table = new DataTable('#data-tbl-vibration', {
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
  <!-- End: DataTables jquery -->

  <!-- Start: Javascript -->
  <script>
    /* Activity monitoring */
    $(document).ready(function() {
      function updateLocation_activity() {
        $.ajax({
          type: "GET",
          url: 'backend-php/activity-location.php',
          success: function(locationActivity) {
            $('#activity-location').html(locationActivity);
          },
          complete: function(locationActivity) {
            setTimeout(updateLocation_activity, 5000);
          }
        });
      }
      setTimeout(updateLocation_activity, 5000);

      function updateTemperature_activity() {
        $.ajax({
          type: "GET",
          url: 'backend-php/activity-temperature.php',
          success: function(tempData) {
            $('#activity-temperature').html(tempData);
          },
          complete: function(tempData) {
            setTimeout(updateTemperature_activity, 5000);
          }
        });
      }
      setTimeout(updateTemperature_activity, 5000);

      function updateVibration_activity() {
        $.ajax({
          type: "GET",
          url: 'backend-php/activity-vibration.php',
          success: function(vibData) {
            $('#activity-vibration').html(vibData);
          },
          complete: function(vibData) {
            setTimeout(updateVibration_activity, 2000);
          }
        });
      }
      setTimeout(updateVibration_activity, 2000);

    });

    /***************************************************************************************/

    async function get_gps_JSON() {
      const response = await fetch('backend-php/map-json.php')
      const data = await response.json();

      var gps_lat = data.map(function(index) {
        return index.value_lat;
      });

      var gps_lon = data.map(function(index) {
        return index.value_lon;
      });

      return {
        gps_lat,
        gps_lon
      };
    }

    setInterval(get_gps_JSON, 5000);


    var gps_map = L.map('gpsMap').setView([0, 0], 1);

    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
      maxZoom: 19,
      attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(gps_map);

    var marker = L.marker([0, 0]).addTo(gps_map);

    let initSetView = true;
    async function gps_map_update() {
      const data = await get_gps_JSON();

      var gps_lat_get = data.gps_lat;
      var gps_lon_get = data.gps_lon;
      var gps_lat_data;
      var gps_lon_data;

      var i;

      for (i = 0; i < gps_lat_get.length; i++) {
        gps_lat_data = gps_lat_get[i];
        gps_lon_data = gps_lon_get[i];
      }

      marker.setLatLng([gps_lat_data, gps_lon_data]);

      if (initSetView) {
        gps_map.setView([gps_lat_data, gps_lon_data], 13);
        initSetView = false;
      }
    }

    setInterval(gps_map_update, 5000);

    /***************************************************************************************/

    /* Charts */
    Chart.defaults.font.size = 15;
    Chart.defaults.color = 'rgb(108, 108, 108)';

    /* Setup */
    const tempData = {
      labels: [],
      datasets: [{
        label: 'Values in °C',
        data: [],
        borderWidth: 2,
        borderColor: 'rgb(171, 41, 106)',
        backgroundColor: 'rgb(171, 41, 106, 0.7)',
        pointStyle: 'circle',
        pointRadius: 3,
        tension: 0.4
      }]
    };

    /* Configuration */
    const tempConfig = {
      type: 'line',
      data: tempData,
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          title: {
            display: true,
            text: 'Temperature Monitoring',
            align: 'center',
            padding: {
              top: 10,
              bottom: 20
            }
          },
          tooltip: {
            enabled: true
          },
        },

        scales: {
          y: {
            stacked: true,
            min: -10,
            max: 60,
            grid: {
              display: false
            },
            border: {
              width: 3
            },
            ticks: {
              beginAtZero: true
            }
          },
          x: {
            display: true,
            grid: {
              display: false
            },
            border: {
              width: 3
            },
          }
        }
      }
    }

    /* Render */
    const tempChart = new Chart(
      document.getElementById('tempChart'),
      tempConfig
    );

    async function get_temp_JSON() {
      const response = await fetch('backend-php/chart-temperature-json.php')
      const data = await response.json();

      var temp_time = data.map(function(index) {
        return index.time_stamp;
      });

      var temp_value = data.map(function(index) {
        return index.value_temp;
      });

      return {
        temp_time,
        temp_value
      };
    }

    setInterval(get_temp_JSON, 5000);

    async function temp_chart() {
      var data = await get_temp_JSON();

      var temp_time_get = data.temp_time;
      var temp_value_get = data.temp_value;
      var temp_time_data;
      var temp_value_data;

      var i;

      for (i = 0; i < temp_time_get.length; i++) {
        temp_time_data = temp_time_get[i];
        temp_value_data = temp_value_get[i];
        //console.log(temp_time_data);
      }

      if (tempChart.data.datasets[0].data.length >= 20) {
        tempChart.data.labels.shift();
        tempChart.data.datasets[0].data.shift();
      }

      tempChart.data.datasets[0].data.push(temp_value_data);
      tempChart.data.labels.push(temp_time_data);

      tempChart.update();
    }

    setInterval(temp_chart, 5000);

    /***************************************************************************************/

    /* Setup */
    const vibData = {
      labels: [],
      datasets: [{
          label: 'X',
          data: [],
          borderWidth: 2,
          borderColor: 'rgb(171, 41, 106)',
          backgroundColor: 'rgb(171, 41, 106, 0.7)',
          pointStyle: 'circle',
          pointRadius: 0,
          tension: 0.4
        },
        {
          label: 'Y',
          data: [],
          borderWidth: 2,
          borderColor: 'rgb(102, 16, 242)',
          backgroundColor: 'rgb(102, 16, 242, 0.7)',
          pointStyle: 'circle',
          pointRadius: 0,
          tension: 0.4
        },
        {
          label: 'Z',
          data: [],
          borderWidth: 2,
          borderColor: 'rgb(108, 117, 125)',
          backgroundColor: 'rgb(108, 117, 125, 0.7)',
          pointStyle: 'circle',
          pointRadius: 0,
          tension: 0.4
        }
      ]
    };

    /* Configuration */
    const vibConfig = {
      type: 'line',
      data: vibData,
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          title: {
            display: true,
            text: 'Vibration Monitoring',
            align: 'center',
            padding: {
              top: 10,
              bottom: 20
            }
          },
          tooltip: {
            enabled: false
          }
        },
        scales: {
          y: {
            stacked: true,
            min: -200,
            max: 200,
            grid: {
              display: false
            },
            border: {
              width: 3
            },
            ticks: {
              beginAtZero: true
            }
          },
          x: {
            display: true,
            grid: {
              display: false
            },
            border: {
              width: 3
            },
          }
        }
      }
    }

    /* Render */
    const vibChart = new Chart(
      document.getElementById('vibChart'),
      vibConfig
    );

    async function get_vib_JSON() {
      const response = await fetch('backend-php/chart-vibration-json.php')
      const data = await response.json();

      var vib_time = data.map(function(index) {
        return index.time_stamp;
      });

      var vib_xvalue = data.map(function(index) {
        return index.value_xvib;
      });

      var vib_yvalue = data.map(function(index) {
        return index.value_yvib;
      });

      var vib_zvalue = data.map(function(index) {
        return index.value_zvib;
      });

      return {
        vib_time,
        vib_xvalue,
        vib_yvalue,
        vib_zvalue
      };
    }

    setInterval(get_vib_JSON, 1000);

    async function vib_chart() {
      var data = await get_vib_JSON();

      var vib_time_get = data.vib_time;
      var vib_xvalue_get = data.vib_xvalue;
      var vib_yvalue_get = data.vib_yvalue;
      var vib_zvalue_get = data.vib_zvalue;

      var vib_time_data;
      var vib_xvalue_data;
      var vib_yvalue_data;
      var vib_zvalue_data;

      var i;

      for (i = 0; i < vib_time_get.length; i++) {
        vib_time_data = vib_time_get[i];
        vib_xvalue_data = vib_xvalue_get[i];
        vib_yvalue_data = vib_yvalue_get[i];
        vib_zvalue_data = vib_zvalue_get[i];

        //console.log(vib_value_data);
      }

      if (vibChart.data.datasets[0].data.length >= 20) {
        vibChart.data.labels.shift();
        vibChart.data.datasets.forEach((dataset) => {
          dataset.data.shift();
        });
      }

      vibChart.data.datasets[0].data.push(vib_xvalue_data);
      vibChart.data.datasets[1].data.push(vib_yvalue_data);
      vibChart.data.datasets[2].data.push(vib_zvalue_data);
      vibChart.data.labels.push(vib_time_data);

      vibChart.update();
    }

    setInterval(vib_chart, 1000);

    /***************************************************************************************/

    /* Data tables */
    $('#btn-refresh').click(function updateDatatable() {
      $('#datatable-location').load("backend-php/data-tbl-location.php")
      $('#datatable-temperature').load("backend-php/data-tbl-temperature.php")
      $('#datatable-vibration').load("backend-php/data-tbl-vibration.php")
    });
  </script>
  <!-- End: Javascript -->
</body>

</html>