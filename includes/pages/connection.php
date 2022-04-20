<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Connection
    </h1>
  </section> <!-- Main content -->


  <section class="content">

    <!-- Default box -->
    <div class="box">
      <div class="box-header with-border">
        <table class="table table-striped">
          <thead style="background-color: black; color: white; " class="thead-dark">
            <tr>
              <th scope="col">id</th>
              <th scope="col">Connection Name</th>
              <th scope="col">Status</th>
              <th scope="col">BlackOrWhite</th>
              <th scope="col">CreatedUser</th>
              <th scope="col">Creation Date</th>
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



  </section> <!-- /.content -->
</div>
<!-- /.content-wrapper -->