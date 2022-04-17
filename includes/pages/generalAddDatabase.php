<?php

$dMessage = "";
$dMessageType = "";


if(isset($_POST['add_black_database']))
{
    $con_name= $_POST['conName'];
    $url_external=$_POST['url_external'];
    $refresh_rate=$_POST['refresh_rate'];
    $usercrated="velikrgl";

    $query = "INSERT INTO connections (con_name,url_external,refresh_rate) VALUES ('$con_name','$url_external','$refresh_rate','','','$usercrated','','1')";
    $query_run =mysqli_query($conn,$query);

}


 if(isset($_POST['addDatabase'])){

            $query = dbQuery("INSERT INTO connections (con_name,url_external,refresh_rate) values('".$_POST['conName']."','".$_POST['url_external']."','".$_POST['refresh_rate']."' ");

            $query = explode(":",$query);
            if($query[0] == "ok") {
                $dMessage = "Staff Added Successfully.";
                $dMessageType = "callout-success"; 
            }  else {
                $dMessage = "An error occurred while adding staff.".$query[1][2];
                $dMessageType = "callout-danger"; 
            }
   
  }

if(isset($_GET['act']) and $_GET['act'] == "edit" and isset($_GET['id']) > 0){
     $accountData = dbPrepare("SELECT * FROM accounts where id = ?",array($_GET['id']));
     $accountData =$accountData->fetch();
  }

?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->

    <section class="content-header">
      <h1>
        Add Database
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
                    <form action="admin.php?page=generalAddDatabase" method="POST" >
                      <label for="formFile" class="form-label">Name of the Connection</label>
                      <input class="form-control" type="text" name="conName">
                      <label for="formFile" class="form-label">Uri of external resourcess</label>
                      <input class="form-control" type="text" name="url_external">
                      <label for="formFile" class="form-label">Refresh Rate:(min)</label>
                      <input class="form-control" type="text" name="refresh_rate">
                      <button style="margin-top: 15px;" type="submit" name="addDatabase" href="#" class="btn btn-primary">Send Database</button>
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
                  <label for="formFile" class="form-label">Name of the Connection</label>
                  <input class="form-control" type="text" id="formtext">
                  <label for="formFile" class="form-label">Uri of external resourcess</label>
                  <input class="form-control" type="text" id="formtext">
                  <label for="formFile" class="form-label">Refresh Rate:(min)</label>
                  <input class="form-control" type="text" id="formtext-refresh">

                  <div class="senddb">
                    <a style="margin-top: 15px;  " href="#" class="btn btn-primary">Send Database</a>
                  </div>


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