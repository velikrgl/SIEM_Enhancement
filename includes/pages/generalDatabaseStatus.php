<?php

$sql = "SELECT COUNT(id) FROM db_status WHERE info_type = 1;"; //ip
$sql2 = "SELECT COUNT(id) FROM db_status WHERE info_type = 2;"; //hash
$sql3 = "SELECT COUNT(id) FROM db_status WHERE info_type = 3;"; //url info
$totalDBSize = 100; //MB
$currentDBSizeSQl = 'SELECT SUM(ROUND(((data_length + index_length) / 1024 / 1024), 2)) AS size FROM information_schema.TABLES WHERE table_schema = "gradproj" LIMIT 1;';



$rows = dbQueryList($sql)->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT);
$rows2 = dbQueryList($sql2)->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT);
$rows3 = dbQueryList($sql3)->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT);
$currentDBSize = dbQueryList($currentDBSizeSQl)->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT);


?>

<?php
// Create connection data by day 
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_DB);


$sql_day ="select count(*) as count_by_day from db_status group by day(data_time)";

$result_day = $conn->query($sql_day);

$arr_day = array();


if($result_day->num_rows > 0){
  while($row_day= $result_day->fetch_assoc()){

    (int)$count_day =$row_day['count_by_day'];
    array_push($arr_day,$count_day);

  }
}
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->

  <section class="content-header">
    <h1>
      Database Status
    </h1>
  </section> <!-- Main content -->


  <section class="content">

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
          <div class="box box-primary">
            <div class="box-header with-border">
              <i class="fa fa-bar-chart-o"></i>

              <h3 class="box-title">Database</h3>

            </div>
            <div class="box-body">
              <canvas id="dbStatus" style="height :250px;"></canvas>
            </div>
            <!-- /.box-body-->
          </div>
          <!-- /.box -->
        </div>

        <div class="col-md-6">
          <div class="box box-danger">
            <div class="box-header with-border">
              <h3 class="box-title">IP HASH URL</h3>
            </div>
            <div class="box-body">
              <canvas id="ipHash" style="height:250px"></canvas>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>

      </div>
      <div class="row">

        <div class="col-md-12">
          <div class="box box-primary">
            <div class="box-header with-border">
              <i class="fa fa-bar-chart-o"></i>

              <h3 class="box-title">Data Entries by Day</h3>

            </div>
            <div class="box-body">
              <canvas id="myChart" style="height :250px;"></canvas>
            </div>
            <!-- /.box-body-->
          </div>
          <!-- /.box -->
        </div>

        <script>
          //Data by Day
          let myChart = document.getElementById('myChart').getContext('2d');

          // Global Options
          Chart.defaults.global.defaultFontFamily = 'Lato';
          Chart.defaults.global.defaultFontSize = 12;
          Chart.defaults.global.defaultFontColor = '#777';

          let massPopChart = new Chart(myChart, {
            type: 'horizontalBar', // bar, horizontalBar, pie, line, doughnut, radar, polarArea
            data: {
              labels: ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'],
              datasets: [{
                label: 'Data',
                data: [
                  <?php echo $arr_day[0] ?>,
                  <?php echo $arr_day[1] ?>,
                  <?php echo $arr_day[2] ?>,
                  <?php echo $arr_day[3] ?>,
                  <?php echo $arr_day[4] ?>,
                  <?php echo $arr_day[5] ?>,
                  <?php echo $arr_day[6] ?>,

                ],

                //backgroundColor:'green',
                backgroundColor: [
                  'rgba(255, 99, 132, 0.6)',
                  'rgba(54, 162, 235, 0.6)',
                  'rgba(255, 206, 86, 0.6)',
                  'rgba(75, 192, 192, 0.6)',
                  'rgba(153, 102, 255, 0.6)',
                  'rgba(255, 159, 64, 0.6)',
                  'rgba(255, 99, 132, 0.6)'
                ],
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

          //Database
          let dbStatusChart = document.getElementById('dbStatus').getContext('2d');

          let massPopChart2 = new Chart(dbStatusChart, {
            type: 'bar', // bar, horizontalBar, pie, line, doughnut, radar, polarArea
            data: {
              labels: ['Database Disk Status'],
              datasets: [{
                label: 'Data-%',
                data: [
                  <?php echo $currentDBSize[0]; ?>,
               0.1,
               0.2,
               0.4,
               0.6,
               0.8,
               1,
               1.2,
               1.4,
               1.6,
               1.8
                ],

                //backgroundColor:'green',
                backgroundColor: [
                  'rgba(255, 99, 132, 0.6)',
                  
                ],
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
        </script>

      </div>
    </body>

  </section> <!-- /.content -->
</div>
<!-- ChartJS -->
<script src="bower_components/chart.js/Chart.js"></script>
<script>
  window.onload = function() {


    //-------------
    //- PIE CHART -
    //-------------
    // Get context with jQuery - using jQuery's .get() method.
    
    var ipHashCanvas = $('#ipHash').get(0).getContext('2d');
    var ipHashChart = new Chart(ipHashCanvas);
    var ipHashData = [{
        value: <?php echo $rows[0] ?>,
        color: '#f56954',
        highlight: '#f56954',
        label: 'ip'
      },
      {
        value: <?php echo $rows2[0] ?>,
        color: '#00a65a',
        highlight: '#00a65a',
        label: 'hash'
      },
      {
        value: <?php echo $rows3[0] ?>,
        color: '#3c8dbc',
        highlight: '#3c8dbc',
        label: 'url'
      }
    ];


    var pieOptions = {
      //Boolean - Whether we should show a stroke on each segment
      segmentShowStroke: true,
      //String - The colour of each segment stroke
      segmentStrokeColor: '#fff',
      //Number - The width of each segment stroke
      segmentStrokeWidth: 2,
      //Number - The percentage of the chart that we cut out of the middle
      percentageInnerCutout: 50, // This is 0 for Pie charts
      //Number - Amount of animation steps
      animationSteps: 100,
      //String - Animation easing effect
      animationEasing: 'easeOutBounce',
      //Boolean - Whether we animate the rotation of the Doughnut
      animateRotate: true,
      //Boolean - Whether we animate scaling the Doughnut from the centre
      animateScale: false,
      //Boolean - whether to make the chart responsive to window resizing
      responsive: true,
      // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
      maintainAspectRatio: true,
      //String - A legend template
      legendTemplate: '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<segments.length; i++){%><li><span style="background-color:<%=segments[i].fillColor%>"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>'
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    ipHashChart.Doughnut(ipHashData, pieOptions);




  }
</script>