<head>

  <script type="text/javascript" src="bower_components\sweetalert2\sweetalert2.all.min.js"></script>
</head>
<?php
$conn = new mysqli('localhost', 'root', '', 'gradproj');
if (isset($_POST['addDatabase_black'])) {

  
  $conName = $_POST['conName'];
  $url_external = $_POST['url_external'];
  $refresh_rate = $_POST['refresh_rate'];
  $t = time();
  $time = (date("Y-m-d", $t));

  $sql = "INSERT INTO connections (connection_name,api_query,fetch_time,blackOrWhite,createdTime,userwhocreated,creationReason,status) VALUES ('$conName','$url_external','$refresh_rate','1','$time','admin','','1')";

  $result = $conn->query($sql);

  echo '<script>Swal.fire("Success", "Black connection added successfully", "success"); </script>';
  
  // Burdan sonra connections tabına yönlenecek

  //redirecLink("admin.php?page=connection");

}

if (isset($_POST['addDatabase_white'])) {

  $conName = $_POST['conName'];
  $url_external = $_POST['url_external'];
  $refresh_rate = $_POST['refresh_rate'];
  $t = time();
  $time = (date("Y-m-d", $t));

  $sql = "INSERT INTO connections (connection_name,api_query,fetch_time,blackOrWhite,createdTime,userwhocreated,creationReason,status) VALUES ('$conName','$url_external','$refresh_rate','0','$time','admin','','1')";

  $result = $conn->query($sql);

  echo '<script>Swal.fire("Success", "White connection added successfully", "success"); </script>';
  
  // Burdan sonra connections tabına yönlenecek

  //redirecLink("admin.php?page=connection");

}
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->


  <section class="content-header">
    <h1>
      Add Connections
    </h1>
  </section> <!-- Main content -->


  <section class="content">

    <!-- Default box -->
    <div class="box">
      <div class="box-header with-border">

      </div>

      <div class="box-body">

        <div class="row">
          <div class="col-sm-6">
            <div class="card">
              <div class="card-body">
                <h3 style="font-weight: bold;" class="card-title">Black List</h3>
                <p class="card-text">Add a txt file to insert database as a black list </p>

                <div class="mb-3">
                  <form action="admin.php?page=generalAddDatabase" method="POST">
                    <label for="formFile" class="form-label">Name of the Connection</label>
                    <input class="form-control" type="text" name="conName">
                    <label for="formFile" class="form-label">Uri of external resourcess</label>
                    <input class="form-control" type="text" name="url_external">
                    <label for="formFile" class="form-label">Refresh Rate:(min)</label>
                    <input class="form-control" type="text" name="refresh_rate">
                    <button style="margin-top: 15px;" type="submit" name="addDatabase_black" href="#" class="btn btn-primary">Send Database</button>
                  </form>
                </div>
              </div>
            </div>
          </div>

          <div style="border-left: 5px solid #e67e22; height: 300px; position: absolute;left: 50%; top: 0;" class="vr"></div>

          <div class="col-sm-6">
            <div class="card">
              <div class="card-body">
                <h3 style="font-weight: bold;" class="card-title">White List</h3>
                <p class="card-text">Add a txt file to insert database as a white list</p>
                <div class="mb-3">
                  <form action="admin.php?page=generalAddDatabase" method="POST">
                    <label for="formFile" class="form-label">Name of the Connection</label>
                    <input class="form-control" type="text" name="conName" id="formtext">
                    <label for="formFile" class="form-label">Uri of external resourcess</label>
                    <input class="form-control" type="text" name="url_external" id="formtext">
                    <label for="formFile" class="form-label">Refresh Rate:(min)</label>
                    <input class="form-control" type="text" name="refresh_rate" id="formtext-refresh">
                    <button style="margin-top: 15px;" type="submit" name="addDatabase_white" href="#" class="btn btn-primary">Send Database</button>
                  </form>

                </div>

              </div>
            </div>
          </div>

        </div>

      </div>
      <!-- /.box-body -->


    </div>
    <!-- /.box -->

  </section> <!-- /.content -->
</div>
<!-- /.content-wrapper -->