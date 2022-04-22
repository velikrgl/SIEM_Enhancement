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
            $conn = new mysqli('localhost', 'root', '', 'gradproj');
            $sql = "SELECT COUNT(id) FROM scanned_db;";


            $result = mysqli_query($conn, $sql);
            $rows = mysqli_fetch_row($result);
            ?>

            <h3><?php echo  $rows[0]; ?> </h3>

            <p>Total Scanned Data</p>
          </div>
          <div class="icon">
            <i class="fa-brands fa-stumbleupon"></i>
          </div>
          <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-green">
          <div class="inner">
            <h3>53<sup style="font-size: 20px">%</sup></h3>

            <p>Database black/white list %</p>
          </div>
          <div class="icon">
            <i class="ion ion-stats-bars"></i>
          </div>
          <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-yellow">
          <div class="inner">
            <?php

            $conn = new mysqli('localhost', 'root', '', 'gradproj');
            $sql = "SELECT COUNT(id) FROM accounts;";


            $result = mysqli_query($conn, $sql);
            $rows = mysqli_fetch_row($result);
            ?>
            <h3><?php echo  $rows[0];  ?></h3>

            <p>User Registrations</p>
          </div>
          <div class="icon">
            <i class="ion ion-person-add"></i>
          </div>
          <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-red">
          <div class="inner">
            <?php

            $conn = new mysqli('localhost', 'root', '', 'gradproj');
            $sql = "SELECT COUNT(id) FROM siem_logs;";


            $result = mysqli_query($conn, $sql);
            $rows = mysqli_fetch_row($result);
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

    <div class="col-md-6">
      <!-- LINE CHART -->
      <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title">Line Chart</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>


          </div>
        </div>


        <div class="box-body chart-responsive">
          <div class="chart" id="line-chart" style="height: 300px;"></div>

        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>

    

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load("current", {
        packages: ["corechart"]
      });
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Language', 'Speakers (in millions)'],
          <?php 
         $sql = "SELECT COUNT(id) FROM scanned_db where  scanned_type=1 ;";
         
         $result = mysqli_query($conn, $sql);
         $rows = mysqli_fetch_row($result);
         $ip = $rows[0];

         $sql2 = "SELECT COUNT(id) FROM scanned_db where  scanned_type=2 ;";
         $result2 = mysqli_query($conn, $sql2);
         $rows2 = mysqli_fetch_row($result2);
         $hash = $rows2[0];

         $sql3 = "SELECT COUNT(id) FROM scanned_db where  scanned_type=3 ;";
         $result3 = mysqli_query($conn, $sql3);
         $rows3 = mysqli_fetch_row($result3);
         $url = $rows3[0];
          ?>
          ['IP', <?php echo $ip ?>],
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

    <body>
      <div id="piechart" style="width: 700px; height: 350px; margin-left: 600px;"></div>
    </body>
  </section>
  <!-- /.content -->



</div>
<!-- /.content-wrapper -->