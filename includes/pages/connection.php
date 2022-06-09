<head>
  <script type="text/javascript" src="bower_components\sweetalert2\sweetalert2.all.min.js"></script>
</head>
<?php

if (isset($_POST['delete-conn'])) {
  $id = $_POST['delete-conn'];

  echo "<script> conn_id =" . $id . ";</script>";
} else {
  echo "<script> conn_id = 0;</script>";
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
              <th scope="col">Update Con </th>
              <th scope="col">Delete Con</th>
            </tr>
          </thead>

          <?php


          $sql = "SELECT * FROM  connections";
          $result = dbQueryList($sql);
          $counted_table=1;



            while ($rows = $result->fetch(PDO::FETCH_ASSOC)) {
          ?>
              <tr>
                <!--FETCHING DATA FROM EACH 
                    ROW OF EVERY COLUMN-->
                <td><?php echo  $counted_table++ ?></td>
                <td id="connection_name_table"><?php echo $rows['connection_name']; ?></td>
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
                <td><button onclick="javascript:conEdit('<?php echo $rows['id']; ?>');" type="button" data-id="<?php echo $rows['id']; ?>" class="btn btn-primary">Update</button></td>

                <!-- Edit Button-->
                <!--<form action="admin.php?page=connection" method="POST">-->
                  <td><button onclick="javascript:conDelete('<?php echo $rows['id']; ?>');" value="<?php echo $rows['id']; ?>" name="delete-conn" type="button" class="btn btn-primary delete-conn">Delete</button></td>
                <!--</form>-->

              </tr>
          <?php
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
          </div>
        </div>
      </div>
    </div>

    <div style="display:none;" id="coneditGEt"></div>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>


    <script>
      var conData;
      $(document).ready(function() {

        $('.update-conn').click(function() {

          var conn_id = $(this).data('id');

          // AJAX request
          $.ajax({
            url: 'includes/pages/update_connections.php',
            type: 'get',

            data: {
              conn_id: conn_id
            },
            success: function(response) {
              // Add response in Modal body
              $('.modal-body').html(response);
              // Display Modal
              $('#update_modal').modal('show');
            }
          });
        });

      });

      
      function conEdit(id){
        //alert(id);

        $.ajax({
            url: 'admin.php?act=conEditGet&id='+id,
            type: 'get',
            success: function(response) {
              conEditSweet(id,response)
            }
           
          });

      }

      function conEditSweet(id,conData){

       conDataVeris = conData.split(",");
       var blakOrWhite,statuson;


        if(conDataVeris[4] == 1) blakOrWhite=" <option value='1' selected>Black</option><option value='0'>White</option>"; else blakOrWhite="<option value='1'>Black</option><option value='0' selected>White</option>";
        if(conDataVeris[8] == 1) statuson='ON<input type="radio" name="status" class="swal2-input statusMod" value="1" checked>OFF<input type="radio" name="status" class="swal2-input statusMod" value="0" >'; else statuson='ON<input type="radio" name="status" class="swal2-input statusMod" value="1" >OFF<input type="radio" name="status" class="swal2-input statusMod" value="0" checked>';
        //2,usom,usom.com,60,1,2022-04-02,admin,usom usage,1

      Swal.fire({
        title: 'Update Connection',
        html:
        '<label class="form-control" >Connection Name</label>'+
        '<input type="text" id="Mconn_name" class="swal2-input" value="'+conDataVeris[1]+'" >'+
        '<label class="form-control" >Api Query:</label>'+
        '<input type="text" id="api-query" class="swal2-input" value="'+conDataVeris[2]+'">'+
        '<label class="form-control" >Fetch Time</label>'+
        '<input type="text" id="fetch_time" class="swal2-input" value="'+conDataVeris[3]+'" >'+
        '<label class="form-control">BlackOrWhite</label>'+
        '<select name="blackorwhite" id="blackorwhite" class="form-control">'+blakOrWhite+'</select>'+'<label style="margin-bottom:10px; margin-top:10px" class="form-control" >Status</label>'+
        statuson,
        confirmButtonText: 'UPDATE',
        focusConfirm: false,
        preConfirm: () => {
          const Mconn_name = Swal.getPopup().querySelector('#Mconn_name').value;
          const api_query = Swal.getPopup().querySelector('#api-query').value;
          const fetch_time = Swal.getPopup().querySelector('#fetch_time').value;
          const blackorwhite = Swal.getPopup().querySelector('#blackorwhite').value;
          const qstatuson = Swal.getPopup().querySelector(".statusMod:checked").value;

          $.ajax({
            url: 'admin.php?act=connectionEdit&id='+id,
            type: 'post',

            data: {
              Mconn_name: Mconn_name, api_query: api_query,fetch_time:fetch_time, blackorwhite:blackorwhite,qstatuson:qstatuson
            },
            success: function(response) {  
              Swal.fire({ position: 'center', icon: 'success', title: 'Connection Updated Successully !', showConfirmButton: false, timer: 1500 });
              setTimeout(function(){location.reload();}, 3000);               

              
            }
          });        

          //return { Mconn_name: Mconn_name, api_query: api_query }

        }
      });


      }


      function conDelete(id){
        //alert(id);

                Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
              }).then((result) => {

                if (result.isConfirmed) {
                  //delete func
                  $.ajax({
                    url: 'admin.php?act=connectionDelete&id=' + id,
                    type: 'get',
                    success: function(response) { 
                      
                      Swal.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                      );

                      location.reload();
                 }

                  });


                  
                } 
              });
      }
    </script>

  </section> <!-- /.content -->
</div>
<!-- /.content-wrapper -->