<?php

if (isset($_POST['addDatabase_black'])) {

  
  $conName = $_POST['conName'];
  $url_external = $_POST['url_external'];
  $refresh_rate = $_POST['refresh_rate'];
  $creation_reason = $_POST['creation_reason'];
  $t = time();
  $time = (date("Y-m-d", $t));


  $query = dbQuery("INSERT INTO connections (connection_name,api_query,fetch_time,blackOrWhite,createdTime,userwhocreated,creationReason,status) VALUES ('$conName','$url_external','$refresh_rate','1','$time','admin','$creation_reason','1')");

  $query = explode(":",$query);
  if($query[0] == "ok") {


    $urlFile = $url_external;
    $lines2 = file_get_contents($urlFile);
    $lines = explode("\n", $lines2);


    $i=0;
/*
    foreach($lines as $data){
      $query = dbQuery("INSERT INTO db_status (ip_hash_url,info_type,type) VALUES ('$data','2','uriDataChech($data)')");
     $i++;
    }*/

    echo '<script>var datas = "'.implode($lines,",").'"; addList = 1; Swal.fire("Success", "Black connection added successfully and '.$i.' datas add database", "success"); </script>';
  }  else {
    echo '<script>Swal.fire("errror", "Wrogn!", "danger"); </script>';
  }


  
  // Burdan sonra connections tabına yönlenecek

  //redirecLink("admin.php?page=connection");

}

if (isset($_POST['addDatabase_white'])) {

  $conName = $_POST['conName'];
  $url_external = $_POST['url_external'];
  $refresh_rate = $_POST['refresh_rate'];
  $creation_reason = $_POST['creation_reason'];
  $t = time();
  $time = (date("Y-m-d", $t));

  $query = dbQuery("INSERT INTO connections (connection_name,api_query,fetch_time,blackOrWhite,createdTime,userwhocreated,creationReason,status) VALUES ('$conName','$url_external','$refresh_rate','0','$time','admin','$creation_reason','1')");

  $query = explode(":",$query);
  if($query[0] == "ok") {
    
    $urlFile = $url_external;
    $lines = file($urlFile);

    $i=0;

    foreach($lines as $data){
      $query = dbQuery("INSERT INTO db_status (ip_hash_url,info_type,type) VALUES ('$data','1','uriDataChech($data)')");
     $i++;
    }

    echo '<script>var datas = "'.implode($lines,",").'"; addList = 1; Swal.fire("Success", "White connection added successfully and '.$i.' datas add database", "success"); </script>';
  }  else {
    echo '<script>Swal.fire("errror", "Wrogn!", "danger"); </script>';
  }
  
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
                    <label for="formFile" class="form-label">creation Reason:</label>
                    <input class="form-control" type="text" name="creation_reason">
                    <label for="formFile" class="form-label">Refresh Rate:(min)</label>
                    <input class="form-control" type="text" name="refresh_rate">
                    <button style="margin-top: 15px;" type="submit" name="addDatabase_black" href="#" class="btn btn-primary">Send Database</button>
                  </form>
                </div>
              </div>
            </div>
          </div>

          <div style="border-left: 5px solid #e67e22; height: 355px; position: absolute;left: 50%; top: 0;" class="vr"></div>

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
                    <label for="formFile" class="form-label">creation Reason:</label>
                    <input class="form-control" type="text" name="creation_reason">
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


  <section class="content">

    <div style="width=100%;">
        <span id="ipNum">0</span>
        <span id="URLNum">0</span>
        <span id="HASHNum">0</span>
    </div>

    <div style="height:300px; width:100%;overflow: auto;background-color: #fff;padding: 20px;" id="dataLog">
    </div>

  </section>



</div>

<script>
datasSplit =  datas.split(",");
dNum = 0;
ipNum = 0;
URLNum = 0;
HASHNum = 0;

if(addList == 1){ addData(datasSplit[dNum]); }

function addData(uri){
        if(uri != "") {
               $.ajax({
                        type: "GET",
                      url: 'admin.php?add=uri&uri='+uri,
                        showLoaderOnConfirm: true,
                        success: function( result ) {
                            $("#dataLog").append("<p>"+result[0]+"</p>");
                            $( "#dataLog" ).scrollTop( $('#dataLog').prop("scrollHeight") );
                            if(result[1] == 1) {
                              ipNum++; 
                              $("#ipNum").html(ipNum);
                            }else if (result[1] == 2) {
                              URLNum++;
                              $("#URLNum").html(URLNum);
                            } else{ 
                              HASHNum++;
                              $("#HASHNum").html(HASHNum);
                            }

                            dNum++;

                            if(dNum < datas.length){
                              addData(datasSplit[dNum]);
                            } else {
                              $("#dataLog").append("<p>Successfull All Data Add</p>");
                              $( "#dataLog" ).scrollTop( $('#dataLog').prop("scrollHeight") );
                            }

                        }
                });
        } 
     }

</script>
<!-- /.content-wrapper -->