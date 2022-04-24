  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->

    <section class="content-header">
      <h1>
        System Health
      </h1>
    </section> <!-- Main content -->


    <section class="content">


      <?php

      $conn = new mysqli('localhost', 'root', '', 'gradproj');
      $sql = "SELECT * FROM  connections";

      $result = $conn->query($sql);
      if ($result->num_rows > 0) {

        while ($rows = $result->fetch_assoc()) {
      ?>
          <!-- Default box -->



          <div class="col-sm-5">
            <div class="col-sm-12">
              <div style="padding: 30px; margin-top: 5px; border: 2px solid black;" class="card">
                <div style="margin-bottom: 15px; border: outset;" class="card-body">
                  <h5 class="card-title" style="font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif; font-size: larger; font-weight: bold;"><?php echo strtoupper($rows['connection_name']); ?> </h5>

                </div>
                <div class="connection_details">

                  <?php $status = $rows['status'];
                  if ($status == 1) {

                  ?>

                    <button style="float: right; font-size: 11px;" type="button" data-toggle="modal" data-target="#connection-details" class="btn btn-primary">Connection Details </button>

                    <i style="color: green; font-weight: bold;" class="fa-solid fa-link fa-xl">
                      <p style="font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif; margin-left: 40px;">Connected</p>
                    </i>
                  <?php
                  } else { ?>

                    <button style="float: right; font-size: 12px;" data-toggle="modal" type="button" data-target="#reset-connection" class="btn btn-danger">Reset Connection</button>

                    <i style="color: red; font-weight: bold;" class="fa-solid fa-bug-slash fa-xl">
                      <p style="font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;   margin-left: 40px;">Disconnect</p>
                      <div style="width: 100px;">

                      </div>
                    </i>

                  <?php
                  }
                  ?>
                </div>

              </div>
            </div>


          </div>

      <?php }
      } ?>
      <div style="margin-top: 30px;" class="clas">

      </div>

      <style>
        .col-sm-6 {
          margin-top: 10px;
        }

        .content {
          margin-top: 50px;
          width: 1500px;
        }
      </style>


      <!--MODALS-->

      <!-- Modal CONNECTION DETAILS-->
      <div class="modal fade" id="connection-details" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLongTitle">Connection Details</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">


            </div>
            <div class="modal-footer">



            </div>
          </div>
        </div>
      </div>

      <!-- Modal RESET CONNECTION -->
      <div class="modal fade" id="reset-connection" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLongTitle">Reset Connection</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              ...
            </div>
            <div class="modal-footer">
             
            </div>
          </div>
        </div>
      </div>

    </section> <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->