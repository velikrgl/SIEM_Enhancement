  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->

    <section class="content-header">
      <h1>
        Monitoring
      </h1>
    </section>    <!-- Main content -->


    <section class="content">
    <div class="row">

        <div class="col-md-6">
          <div class="box box-danger">
            <div class="box-header with-border">
              <h3 class="box-title">Scans</h3>
            </div>
            <div class="box-body">
              <canvas id="dbStatus" style="height:250px"></canvas>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      
        <div class="col-md-6">
          <div class="box box-danger">
            <div class="box-header with-border">
              <h3 class="box-title">Malicious IPs</h3>
            </div>
            <div class="box-body">
              <canvas id="ipHash" style="height:250px"></canvas>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>

    </div>
</section>    <!-- /.content -->
  </div>
<!-- ChartJS -->
<script src="bower_components/chart.js/Chart.js"></script>
<script>
    
 window.onload = function () {

    //-------------
    //- PIE CHART -
    //-------------
    // Get context with jQuery - using jQuery's .get() method.
    var dbStatusCanvas = $('#dbStatus').get(0).getContext('2d');
    var dbStatusChart       = new Chart(dbStatusCanvas);
    var dbStatusData        = [
      {
        value    : 150,
        color    : '#f56954',
        highlight: '#f56954',
        label    : 'db1'
      },
      {
        value    : 210,
        color    : '#00a65a',
        highlight: '#00a65a',
        label    : 'db2'
      }
    ];

    var ipHashCanvas = $('#ipHash').get(0).getContext('2d');
    var ipHashChart       = new Chart(ipHashCanvas);
    var ipHashData        = [
      {
        value    : 120,
        color    : '#f56954',
        highlight: '#f56954',
        label    : 'ip'
      },
      {
        value    : 60,
        color    : '#00a65a',
        highlight: '#00a65a',
        label    : 'hash'
      },
      {
        value    : 180,
        color    : '#3c8dbc',
        highlight: '#3c8dbc',
        label    : 'url'
      }
    ];


    var pieOptions     = {
      //Boolean - Whether we should show a stroke on each segment
      segmentShowStroke    : true,
      //String - The colour of each segment stroke
      segmentStrokeColor   : '#fff',
      //Number - The width of each segment stroke
      segmentStrokeWidth   : 2,
      //Number - The percentage of the chart that we cut out of the middle
      percentageInnerCutout: 50, // This is 0 for Pie charts
      //Number - Amount of animation steps
      animationSteps       : 100,
      //String - Animation easing effect
      animationEasing      : 'easeOutBounce',
      //Boolean - Whether we animate the rotation of the Doughnut
      animateRotate        : true,
      //Boolean - Whether we animate scaling the Doughnut from the centre
      animateScale         : false,
      //Boolean - whether to make the chart responsive to window resizing
      responsive           : true,
      // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
      maintainAspectRatio  : true,
      //String - A legend template
      legendTemplate       : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<segments.length; i++){%><li><span style="background-color:<%=segments[i].fillColor%>"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>'
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    dbStatusChart.Doughnut(dbStatusData, pieOptions);
    ipHashChart.Doughnut(ipHashData, pieOptions);

    

  }  
  
    </script>  