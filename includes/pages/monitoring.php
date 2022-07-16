<?php

$sql = "SELECT COUNT(id) FROM scanned_db WHERE scanned_type = 1;"; //ip
$sql2 = "SELECT COUNT(id) FROM scanned_db WHERE scanned_type = 2;"; //hash
$sql3 = "SELECT COUNT(id) FROM scanned_db WHERE scanned_type = 3;"; //url info



$ctTows = dbQueryList($sql)->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT);
$ctTows2 = dbQueryList($sql2)->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT);
$ctTows3 = dbQueryList($sql3)->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT);


?>

<?php

// Create connection SCANNED DATA
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_DB);


$sql_scanned ="select count(*) as count_by_month  from scanned_db group by month(scanned_time)";

$result_scanned = $conn->query($sql_scanned);

$arr_scanned = array();


if($result_scanned->num_rows > 0){
  while($row_scanned= $result_scanned->fetch_assoc()){

    (int)$count_scanned =$row_scanned['count_by_month'];
    array_push($arr_scanned,$count_scanned);

  }
}
?>


  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->

    <section class="content-header">
      <h1>
        Monitoring
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
            <!-- Bar chart -->
            <div class="box box-primary">
              <div class="box-header with-border">
                <i class="fa fa-bar-chart-o"></i>

                <h3 class="box-title">Scanned Data</h3>

              </div>
              <div class="box-body">
                <canvas id="myChart" style="height :250px;"></canvas>
              </div>
              <!-- /.box-body-->
            </div>
            <!-- /.box -->
          </div>

          <div class="col-md-6">
            <div class="box box-danger">
              <div class="box-header with-border">
                <h3 class="box-title">Malicious Data</h3>
              </div>
              <div class="box-body">
                <canvas id="ipHash" style="height:250px"></canvas>
              </div>
              <!-- /.box-body -->
            </div>
            <!-- /.box -->
          </div>
        </div>

        <script>
          let myChart = document.getElementById('myChart').getContext('2d');

          // Global Options
          Chart.defaults.global.defaultFontFamily = 'Lato';
          Chart.defaults.global.defaultFontSize = 10;
          Chart.defaults.global.defaultFontColor = '#777';

          let massPopChart = new Chart(myChart, {
            type: 'bar', // bar, horizontalBar, pie, line, doughnut, radar, polarArea
            data: {
              labels: ['January', 'February', 'March', 'April', 'May', 'June','July','August', 'September','October','November','December'],
              datasets: [{
                label: 'Scanned Data',
                data: [
                  <?php echo $arr_scanned[0] ?>,
                  <?php echo $arr_scanned[1] ?>,
                  <?php echo $arr_scanned[2] ?>,
                  <?php echo $arr_scanned[3] ?>,
                  <?php echo $arr_scanned[4] ?>,
                  <?php echo $arr_scanned[5] ?>,
                  <?php echo $arr_scanned[6] ?>,
                  <?php echo $arr_scanned[7] ?>,
                  <?php echo $arr_scanned[8] ?>,
                  <?php echo $arr_scanned[9] ?>,
                  <?php echo $arr_scanned[10] ?>,
                  <?php echo $arr_scanned[11] ?>,
                ],
                //backgroundColor:'green',
                backgroundColor: [
                  'rgba(255, 99, 132, 0.6)',
                  'rgba(255, 99, 132, 0.6)',
                  'rgba(255, 99, 132, 0.6)',
                  'rgba(255, 99, 132, 0.6)',
                  'rgba(255, 99, 132, 0.6)',
                  'rgba(255, 99, 132, 0.6)',
                  'rgba(255, 99, 132, 0.6)',
                  'rgba(255, 99, 132, 0.6)',
                  'rgba(255, 99, 132, 0.6)',
                  'rgba(255, 99, 132, 0.6)',
                  'rgba(255, 99, 132, 0.6)',
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
        </script>
      </body>

      </html>





      <div class="title">
        <h3 style="margin-left: 20px;">Top 10 Countries - IP Reputation </h3>
      </div>
      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <table class="table table-striped">
            <thead style="background-color: black; color: white; " class="thead-dark">
              <tr>
                <th scope="col">ID</th>
                <th scope="col">Country</th>
                <th scope="col">City</th>
                <th scope="col">Count</th>
                <th scope="col">Block Status</th>
                <th scope="col">Scan Time</th>
              </tr>
            </thead>

            <?php

            $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_DB);
            $sql = "SELECT id,country,city,COUNT(country) as number,blocked,scanned_time FROM `scanned_db` GROUP BY country ORDER BY number DESC LIMIT 0,10";


            $result = $conn->query($sql);

            //TOP-10-
            //SELECT id,country,city,COUNT(country) as number,blocked,scanned_time FROM `scanned_db` GROUP BY country ORDER BY number DESC LIMIT 0,10;



            if ($result->num_rows > 0) {
              $id_count = 1;
              while ($rows = $result->fetch_assoc()) {
            ?>
                <tr>
                  <!--FETCHING DATA FROM EACH 
                    ROW OF EVERY COLUMN-->
                  <td><?php echo $id_count++; ?></td>
                  <td><?php echo $rows['country']; ?></td>
                  <td><?php echo $rows['city']; ?></td>
                  <td><?php echo $rows['number']; ?></td>
                  <?php $status = $rows['blocked'];
                  if ($status == 1) {
                  ?>
                    <td style="background-color: greenyellow;"> <?php echo "Blocked" ?></td>
                  <?php
                  } else { ?>
                    <td style="background-color: red; color: white;"> <?php echo "NO Blocked" ?></td>
                  <?php
                  }
                  ?>
                  <td><?php echo $rows['scanned_time']; ?></td>

                </tr>
            <?php
              }
            } else {
              echo "No Result";
            }

            ?>



          </table>
        </div>
      </div>
    </section> <!-- /.content -->
  </div>
  <!-- ChartJS -->
  <script src="bower_components/chart.js/Chart.js"></script>



  <script>
    window.onload = function() {

      var ipHashCanvas = $('#ipHash').get(0).getContext('2d');
      var ipHashChart = new Chart(ipHashCanvas);
      var ipHashData = [{
          value: <?php echo $ctTows[0]; ?>,
          color: '#f56954',
          highlight: '#f56954',
          label: 'ip'
        },
        {
          value: <?php echo $ctTows2[0]; ?>,
          color: '#00a65a',
          highlight: '#00a65a',
          label: 'hash'
        },
        {
          value: <?php echo $ctTows3[0]; ?>,
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

  <script>


  </script>