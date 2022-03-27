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

          $conn = new mysqli('localhost','root','','gradproj');
          $sql = "SELECT * FROM  connections";
          $sql2 = "SELECT * FROM connection_info";
          $result = $conn->query($sql);
          $result2 =$conn->query($sql2);

    
          if ($result->num_rows > 0) {

              while ($rows = $result->fetch_assoc()) {
          ?>
                <tr>
                  <!--FETCHING DATA FROM EACH 
                    ROW OF EVERY COLUMN-->
                  <td><?php echo $rows['id']; ?></td>
                  <td><?php echo $rows['connection_name']; ?></td>
                  <td><?php echo $rows['status']; ?></td>
                 
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

    
    


    <!-- /.box-body -->


    <!-- /.box-footer-->
</div>
<!-- /.box -->

</section> <!-- /.content -->
</div>
<!-- /.content-wrapper -->