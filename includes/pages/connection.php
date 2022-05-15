<head>
  <script type="text/javascript" src="bower_components\sweetalert2\sweetalert2.all.min.js"></script>
</head>
<?php

if (isset($_POST['delete-conn'])) {
$id = $_POST['delete-conn'];

$conn = new mysqli('localhost', 'root', '', 'gradproj');


$sql = "DELETE FROM connections WHERE id=$id";

$result = $conn->query($sql);


//sweet alert needs to be use 
  
 
  

  // Burdan sonra connections tabına yönlenecek

  //redirecLink("admin.php?page=connection");

}

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Connections
    </h1>
  </section> <!-- Main content -->


  <section class="content">

    <!-- Default box -->
    <div class="box">
      <div class="box-header with-border">
        <table class="table table-striped">
          <thead style="background-color: black; color: white; " class="thead-dark">
            <tr>
              <th scope="col">ID</th>
              <th scope="col">Connection Name</th>
              <th scope="col">Status</th>
              <th scope="col">BlackOrWhite</th>
              <th scope="col">CreatedUser</th>
              <th scope="col">Creation Date</th>
              <th scope="col">Edit Con </th>
              <th scope="col">Delete Con</th>
            </tr>
          </thead>

          <?php


        $sql = "SELECT * FROM  connections";
        $result =dbQueryList($sql);



          if (count($result->fetch(PDO::FETCH_ASSOC)) > 0) {

            while ($rows = $result->fetch(PDO::FETCH_ASSOC)) {
          ?>
              <tr>
                <!--FETCHING DATA FROM EACH 
                    ROW OF EVERY COLUMN-->
                <td><?php echo $rows['id']; ?></td>
                <td><?php echo $rows['connection_name']; ?></td>
                <?php $status = $rows['status'];
                if ($status == 1) {
                ?>
                  <td style="background-color: greenyellow;"> <?php echo "Active" ?></td>
                <?php
                } else { ?>
                  <td style="background-color: red; color: white;"> <?php echo "NO Active" ?></td>
                <?php
                }
                ?>

                <?php $blcwht = $rows['blackOrWhite'];
                if ($blcwht == 1) {
                ?>
                  <td style="background-color: black; color: white;"> <?php echo "BlackList" ?></td>
                <?php
                } else { ?>
                  <td style="background-color: white; color: black;"> <?php echo "WhiteList" ?></td>
                <?php
                }
                ?>
                <td><?php echo $rows['userwhocreated']; ?></td>
                <td><?php echo $rows['createdTime']; ?></td>
                <td><button id="<?php echo $rows['id']; ?>" type="submit" class="btn btn-primary update-conn">Edit</button></td>
               <!-- Edit Button-->
                <form action="admin.php?page=connection" method="POST">
                  <td><button value="<?php echo $rows['id']; ?>" name="delete-conn" type="submit" class="btn btn-primary delete-conn">Delete</button></td>
                </form>
              
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

    <div id="update_modal" class="modal fade">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Update Connection</h4>
          </div>
          <div id="modal-body-info" class="modal-body">

            <form method="post" id="insert_form">
              <label>Connection Name</label>
              <input type="text" name="conn-name" id="conn-name" class="form-control" />
              <br />
              <label>Api Query</label>
              <input type="text" name="api-query" id="api-query" class="form-control" />
              <br />
              <label>Fetch Time</label>
              <input type="text" name="fetch_time" id="fetch_time" class="form-control" />
              <br />
              <label>BlackOrWhite</label>
              <select name="blackorwhite" id="blackorwhite" class="form-control">
                <option value="Black">Black</option>
                <option value="White">White</option>
              </select>
              <br />

              <div class="form-check form-check-inline">
                <label>Status:</label>
                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadioOptions" value="status-on" />
                <label class="form-check-label" for="inlineRadio1">ON</label>
                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadioOptions" value="status-off" />
                <label class="form-check-label" for="inlineRadio2">OFF</label>
              </div>


          </div>
          <br />
          <input type="hidden" name="conn_id" id="conn_id" />
          <input type="submit" name="insert" id="insert" value="Update" class="btn btn-success" />
          </form>
        </div>
      </div>
    </div>
</div>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script>
  $(document).ready(function() {
    $(document).on('click', '.update-conn', function() {
      var conn_id = $(this).attr("id");
      $('#update_modal').modal("show");

      $.ajax({
        url: "includes/pages/update_connections.php",
        method: "POST",
        data: {
          conn_id: conn_id
        },
        dataType: "json",
        success: function(data) {

          $('#modal-body-info').html(response);
         

          console.log("success");
          $('#conn-name').val(data.conn-name);
          $('#api-query').val(data.api-query);
          $('#fetch_time').val(data.fetch_time);
          $('#blackorwhite').val(data.blackorwhite);
          $('#inlineRadioOptions').val(data.inlineRadioOptions);
          $('#conn_id').val(data.conn_id);
          $('#insert').val("Update");
        


        }


      });
    });


  });
</script>

</section> <!-- /.content -->
</div>
<!-- /.content-wrapper -->