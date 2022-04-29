  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->

    <section class="content-header">
      <h1>
        Monitoring
      </h1>
    </section> <!-- Main content -->


    <section class="content">
      <div class="row">

        <div class="col-md-6">
          <!-- Bar chart -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <i class="fa fa-bar-chart-o"></i>

              <h3 class="box-title">Bar Chart</h3>

            </div>
            <div class="box-body">
              <canvas id="bar-chart" style="height :250px;"></canvas>
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

              $conn = new mysqli('localhost', 'root', '', 'gradproj');
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

      //-------------
      //- PIE CHART -
      //-------------
      // Get context with jQuery - using jQuery's .get() method.
      /*
       * BAR CHART
       * ---------
       */
      var bardataCanvas = $('#bar-chart').get(0).getContext('2d');
      var barDataChart = new Chart(bardataCanvas);
      var bar_data = {
        data: [
          ['January', 10],
          ['February', 8],
          ['March', 4],
          ['April', 13],
          ['May', 17],
          ['June', 9]
        ],
        color: '#3c8dbc'
      }
      $.plot('#bar-chart', [bar_data], {
        grid: {
          borderWidth: 1,
          borderColor: '#f3f3f3',
          tickColor: '#f3f3f3'
        },
        series: {
          bars: {
            show: true,
            barWidth: 0.5,
            align: 'center'
          }
        },
        xaxis: {
          mode: 'categories',
          tickLength: 0
        }
      })
      /* END BAR CHART */



      var ipHashCanvas = $('#ipHash').get(0).getContext('2d');
      var ipHashChart = new Chart(ipHashCanvas);
      var ipHashData = [{
          value: 120,
          color: '#f56954',
          highlight: '#f56954',
          label: 'ip'
        },
        {
          value: 60,
          color: '#00a65a',
          highlight: '#00a65a',
          label: 'hash'
        },
        {
          value: 180,
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

      barDataChart.Doughnut(bar_data, pieOptions);
      ipHashChart.Doughnut(ipHashData, pieOptions);



    }
  </script>

  <script>


  </script>