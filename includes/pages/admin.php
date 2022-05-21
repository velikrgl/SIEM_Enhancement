<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Dashboard
      <small>Control Panel</small>
    </h1>

  </section>

  <!-- Main content -->
  <section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-aqua">
          <div class="inner">
            <?php

            $sql = "SELECT COUNT(id) FROM scanned_db;";
            $rows = dbQueryList($sql)->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT);
            ?>

            <h3><?php echo  $rows[0]; ?> </h3>

            <p>Total Scanned Data</p>
          </div>
          <div class="icon">
            <i class="fa-brands fa-stumbleupon"></i>
          </div>
          <a href="admin.php?page=monitoring" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>

      <!-- ./col -->
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-green">
          <div class="inner">
            <!-- db_status database;
          info type ; 
          1- black list
          2- white list
          type ;
          1-ip
          2-hash
          3-url

         
          -->

            <?php

            // Create connection data by month 
            $conn = new mysqli('localhost', 'root', '', 'gradproj');


            $sql = "select count(*) as count_by_month  from db_status group by month(data_time) ";
            $sql_incominglog ="select count(*) as count_by_month  from siem_logs group by month(log_time)";

            $result = $conn->query($sql);
            $result_incoming = $conn->query($sql_incominglog);
            $array_mont = array();
            $array_mont_incoming = array();

            if ($result->num_rows > 0) {

              while ($rows = $result->fetch_assoc()) {

                (int)$counted_month = $rows['count_by_month'];
                array_push($array_mont, $counted_month);
              }
            }

            if($result_incoming->num_rows>0){
              while($row_incoming = $result_incoming->fetch_assoc()){

                (int)$count_incoming =$row_incoming['count_by_month'];
                array_push($array_mont_incoming,$count_incoming);

              }
            }
            ?>
            <?php

            $sql = "SELECT COUNT(id) FROM db_status WHERE info_type = 1;";
            $sql2 = "SELECT COUNT(id) FROM db_status WHERE info_type = 2;";

            $rows = dbQueryList($sql)->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT);
            $rows2 = dbQueryList($sql2)->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT);

            $total = $rows[0] + $rows2[0];


            ?>
            <h3><?php echo floor(($rows[0] / $total) * 100) ?><sup style="font-size: 20px">%</sup></h3>

            <p>Percentage of black list in all data </p>
          </div>
          <div class="icon">
            <i class="ion ion-stats-bars"></i>
          </div>
          <a href="admin.php?page=connection" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>


      <!-- ./col -->
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-yellow">
          <div class="inner">
            <?php

            $sql = "SELECT COUNT(id) FROM accounts;";
            $rows = dbQueryList($sql)->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT);
            ?>
            <h3><?php echo  $rows[0];  ?></h3>

            <p>User Registrations</p>
          </div>
          <div class="icon">
            <i class="ion ion-person-add"></i>
          </div>
          <a href="admin.php?page=accounts" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-red">
          <div class="inner">
            <?php

            $sql = "SELECT COUNT(id) FROM siem_logs;";
            $rows = dbQueryList($sql)->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT);
            ?>
            <h3><?php echo $rows[0] ?></h3>
            <p>Incoming Logs</p>
          </div>
          <div class="icon">
            <i class="ion ion-pie-graph"></i>
          </div>
          <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
    </div>

    <!DOCTYPE html>
    <html lang="en">

    <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.min.js"></script>
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    </head>

    <body>
      <div class="row">

        <div class="col-md-6">
          <!-- Bar chart -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <i class="fa fa-bar-chart-o"></i>

              <h3 class="box-title">Data Entries by Month</h3>

            </div>
            <div class="box-body">
              <canvas id="scanned_chart" style="height :250px;"></canvas>
            </div>
            <!-- /.box-body-->
          </div>
          <!-- /.box -->
        </div>

        <div class="col-md-6">

          <body>
            <div id="piechart" style="display: flex; float: right; width: 100%; height: 340px;"></div>
          </body>
        </div>


      </div>

      <div class="row">
        <div class="col-md-6">

          <div class="box box-primary">
            <div class="box-header with-border">
              <i class="fa fa-bar-chart-o"></i>

              <h3 class="box-title">Incoming Logs</h3>

            </div>
            <div class="box-body">
              <canvas id="incomingLog" style="height :250px; "></canvas>
            </div>
            <!-- /.box-body-->
          </div>
          <!-- /.box -->
        </div>

        <div class="col-md-6">

          <div class="box box-primary">
            <div class="box-header with-border">
              <i class="fa fa-bar-chart-o"></i>

              <h3 class="box-title">Black & White List</h3>

            </div>
            <div class="box-body">
              <canvas id="blackwhite" style="height :250px; "></canvas>
            </div>
            <!-- /.box-body-->
          </div>
          <!-- /.box -->
        </div>


      </div>

      <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
      <script type="text/javascript">
        google.charts.load("current", {
          packages: ["corechart"]
        });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
          var data = google.visualization.arrayToDataTable([
            ['Data', 'Scanned'],
            <?php
            $sql = "SELECT COUNT(id) FROM scanned_db where  scanned_type=1 ;";

            $rows = dbQueryList($sql)->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT);
            $ip = $rows[0];

            $sql2 = "SELECT COUNT(id) FROM scanned_db where  scanned_type=2 ;";
            $rows2 = dbQueryList($sql2)->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT);
            $hash = $rows2[0];

            $sql3 = "SELECT COUNT(id) FROM scanned_db where  scanned_type=3 ;";
            $rows3 = dbQueryList($sql3)->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT);
            $url = $rows3[0];
            ?>['IP', <?php echo $ip ?>],
            ['HASH', <?php echo $hash ?>],
            ['URL', <?php echo $url ?>],

          ]);

          var options = {
            legend: 'none',
            pieSliceText: 'label',
            title: 'Scanned Data Distribution',
            pieStartAngle: 100,
          };

          var chart = new google.visualization.PieChart(document.getElementById('piechart'));
          chart.draw(data, options);
        }
      </script>


      <script>
        let scanned_chart = document.getElementById('scanned_chart').getContext('2d');


        // Global Options
        Chart.defaults.global.defaultFontFamily = 'Lato';
        Chart.defaults.global.defaultFontSize = 10;
        Chart.defaults.global.defaultFontColor = '#777';


        let massPopChart = new Chart(scanned_chart, {
          type: 'line', // bar, horizontalBar, pie, line, doughnut, radar, polarArea
          data: {
            labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
            datasets: [{
              label: 'Data Entries',
              data: [
                <?php  echo $array_mont[0]?>,
                <?php  echo $array_mont[1]?>,
                <?php  echo $array_mont[2]?>,
                <?php  echo $array_mont[3]?>,
                <?php  echo $array_mont[4]?>,
                <?php  echo $array_mont[5]?>,
                <?php  echo $array_mont[6]?>,
                <?php  echo $array_mont[7]?>,
                <?php  echo $array_mont[8]?>,
                <?php  echo $array_mont[9]?>,
                <?php  echo $array_mont[10]?>,
                <?php  echo $array_mont[11]?>,
               
              ],
              backgroundColor: 'green',

              borderWidth: 1,
              borderColor: '#777',
              hoverBorderWidth: 3,
              hoverBorderColor: '#000'
            }]
          },
          options: {
            title: {
              display: true,
              fontSize: 12
            },
            legend: {
              display: true,
              position: 'right',
              labels: {
                fontColor: '#000'
              }
            },
            layout: {
              padding: {
                left: 50,
                right: 0,
                bottom: 0,
                top: 0
              }
            },
            tooltips: {
              enabled: true
            }
          }
        });


        let incomingLogs = document.getElementById('incomingLog').getContext('2d');


        let massPopChart3 = new Chart(incomingLogs, {
          type: 'line', // bar, horizontalBar, pie, line, doughnut, radar, polarArea
          data: {
            labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
            datasets: [{
              label: 'Data Entries',
              data: [
               <?php echo $array_mont_incoming[0] ?>,
               <?php echo $array_mont_incoming[1] ?>,
               <?php echo $array_mont_incoming[2] ?>,
               <?php echo $array_mont_incoming[3] ?>,
               <?php echo $array_mont_incoming[4] ?>,
               <?php echo $array_mont_incoming[5] ?>,
               <?php echo $array_mont_incoming[6] ?>,
               <?php echo $array_mont_incoming[7] ?>,
               <?php echo $array_mont_incoming[8] ?>,
               <?php echo $array_mont_incoming[9] ?>,
               <?php echo $array_mont_incoming[10] ?>,
               <?php echo $array_mont_incoming[11] ?>,

              ],
              backgroundColor: '#cd2626',

              borderWidth: 1,
              borderColor: '#777',
              hoverBorderWidth: 3,
              hoverBorderColor: '#000'
            }]
          },
          options: {
            title: {
              display: true,
              fontSize: 12
            },
            legend: {
              display: true,
              position: 'right',
              labels: {
                fontColor: '#000'
              }
            },
            layout: {
              padding: {
                left: 50,
                right: 0,
                bottom: 0,
                top: 0
              }
            },
            tooltips: {
              enabled: true
            }
          }
        });


        <?php 
        
        $sql_black = "SELECT COUNT(id) FROM `db_status` WHERE blackorWhite=1";
        $sql_white = "SELECT COUNT(id) FROM `db_status` WHERE blackorWhite=0";

        $result_black = $conn->query($sql_black);
        $result_white = $conn->query($sql_white);
        
        $row_black=mysqli_fetch_array($result_black);
        $row_white=mysqli_fetch_array($result_white);

        ?>
        let blackwhite = document.getElementById('blackwhite').getContext('2d');

        let massPopChart4 = new Chart(blackwhite, {
          type: 'bar', // bar, horizontalBar, pie, line, doughnut, radar, polarArea
          data: {
            labels: ['Black', 'White'],
            datasets: [{
              label: 'Data ',
              data: [
                <?php echo $row_black[0] ?>,
                <?php echo $row_white[0] ?>,
                5,
                10,
                15,
                20,

              ],
              backgroundColor: [
                'rgba(0, 0, 0, 1)',
                'rgba(255, 255, 255, 1)'
              ],

              borderWidth: 3,
              borderColor: '#777',
              hoverBorderWidth: 3,
              hoverBorderColor: '#000'
            }]
          },
          options: {
            title: {
              display: true,
              fontSize: 12
            },
            legend: {
              display: true,
              position: 'right',
              labels: {
                fontColor: '#000'
              }
            },
            layout: {
              padding: {
                left: 50,
                right: 0,
                bottom: 0,
                top: 0
              }
            },
            tooltips: {
              enabled: true
            }
          }
        });
      </script>


  </section>
  <!-- /.content -->



</div>
<!-- /.content-wrapper -->