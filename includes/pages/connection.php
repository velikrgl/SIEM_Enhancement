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
              <th scope="col">Update Connection</th>
            </tr>
          </thead>

          <?php

          $conn = new mysqli('localhost', 'root', '', 'gradproj');
          $sql = "SELECT * FROM  connections";

          $result = $conn->query($sql);



          if ($result->num_rows > 0) {

            while ($rows = $result->fetch_assoc()) {
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
                <td><button id="update_connection" type="button" class="btn btn-primary update-conn">Update</button></td>

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


      <!-- Modal RESET CONNECTION -->
      <div class="modal fade" id="update_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" style="font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif; font-weight: bolder; font-size: 20px;" id="exampleModalLongTitle">Reset Connection</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            <pre>See the connections tab to update connection !</pre>  
            
            </div>
            <div class="modal-footer">
             
            </div>
          </div>
        </div>
      </div>

      <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
      <script>

        $(document).ready(function(){
        $('.update-conn').click (function(){

          $('#update_modal').modal("show");
        

        var con_name = $(this).attr("id");
        console.log("test");
        console.log(con_name);
        $.ajax({
        url:"includes/pages/conn_details.php",
        method:"post",
        data:{con_name:con_name},
        success:function(data){

        $('#connection_details_body').html(data);
        }

        });

         
          
          
          });
        
 });


      </script>

  </section> <!-- /.content -->
</div>
<!-- /.content-wrapper -->