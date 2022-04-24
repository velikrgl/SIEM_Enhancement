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



            <div  class="col-sm-5">
              <div class="col-sm-12">
                <div style="padding: 30px; border: 2px solid black;" class="card">
                  <div class="card-body">
                    <h5 class="card-title " style="font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif; font-size: larger; font-weight: bold;"><?php echo strtoupper($rows['connection_name']); ?> </h5>

                  </div>
                  <div class="connection_details">
                    <?php $status = $rows['status'];
                    if ($status == 1) {
                    ?>
                      <i style="color: green; font-weight: bold;" class="fa-solid fa-link fa-xl">
                        <p style="font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif; margin-left: 40px;">Connected</p>
                      </i>
                    <?php
                    } else { ?>
                      <button style="float: right; font-size: 12px;" type="button" class="btn btn-primary">Reset Connection</button>
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


    </section> <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->