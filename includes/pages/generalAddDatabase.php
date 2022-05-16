<script>datas= "";addListSrat = 0;</script>

<?php

if (isset($_POST['addDatabase_black'])) {

  
  $conName = $_POST['conName'];
  $url_external = $_POST['url_external'];
  $refresh_rate = $_POST['refresh_rate'];
  $creation_reason = $_POST['creation_reason'];
  $t = time();
  $time = (date("Y-m-d", $t));

  $query = dbQueryLastId("INSERT INTO connections (connection_name,api_query,fetch_time,blackOrWhite,createdTime,userwhocreated,creationReason,status) VALUES ('$conName','$url_external','$refresh_rate','1','$time','$Y_user','$creation_reason','1')");

  $query = explode(":",$query);
  if($query[0] == "ok") {

    $lastID = $query[1] ;
    
    $urlFile = "url-list.txt";
    $lines = file($urlFile);
    $lines = str_replace("\n","",$lines);

    $i=0;

    echo '<script>var datas = "'.implode($lines,",").'"; uriType=1; uriConnectID="'.$lastID .'";  addListSrat = 1; Swal.fire("Success", "Black connection added successfully and '.$i.' datas add database", "success"); </script>';
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

  $query = dbQueryLastId("INSERT INTO connections (connection_name,api_query,fetch_time,blackOrWhite,createdTime,userwhocreated,creationReason,status) VALUES ('$conName','$url_external','$refresh_rate','2','$time','$Y_user','$creation_reason','1')");

  $query = explode(":",$query);
  if($query[0] == "ok") {

    $lastID = $query[1] ;
    
    $urlFile = "url-list.txt";
    $lines = file($urlFile);
    $lines = str_replace("\n","",$lines);


    $i=0;

    echo '<script>var datas = "'.implode($lines,",").'";  uriType=2; uriConnectID="'.$lastID .'";  addListSrat = 1; Swal.fire("Success", "White connection added successfully and '.$i.' datas add database", "success"); </script>';
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
    <div>
      <button id="startStopButton" onclick="javascript:ssButton();" style="display:none;" class="btn btn-primary">STOP</button>
    </div>

    <div style="height:300px; width:100%;overflow: auto;background-color: #fff;padding: 20px; clear=both;" id="dataLog">
    </div>

  </section>



</div>

<script>

 

if(datas != "") datasSplit =  datas.split(",");
dNum = 0;
ipNum = 0;
URLNum = 0;
HASHNum = 0;

if(addListSrat == 1){ addData(datasSplit[dNum]);  $("#startStopButton").show(); }

function ssButton(){ 
  if(addListSrat == 1) {
    addListSrat = 0;
    $("#startStopButton").html("START");
  } else {
    addListSrat = 1;
    $("#startStopButton").html("STOP");
    addData(datasSplit[dNum]);
  }
}

function addData(uri){
        if(uri != "" && addListSrat == 1) {
               $.ajax({
                        type: "GET",
                      url: 'admin.php?add=uri&uri='+uri+'&uriType='+uriType+'&conID='+uriConnectID,
                        showLoaderOnConfirm: true,
                        success: function( result ) {
                            $("#dataLog").append("<p>"+result+"</p>");
                            $( "#dataLog" ).scrollTop( $('#dataLog').prop("scrollHeight") );
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