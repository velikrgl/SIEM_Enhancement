  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->

    <section class="content-header">
      <h1>
        List Database
      </h1>
    </section> <!-- Main content -->


    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">

          <div class="form-check">
            <input class="form-check-input" type="checkbox" value="" id="blackcheck">
            <label class="form-check-label" for="flexCheckDefault">All</label>

            <input style="margin-left: 30px;" class="form-check-input" type="checkbox" value="" id="whitecheck">
            <label class="form-check-label" for="flexCheckDefault">Black List</label>

            <input style="margin-left: 30px;" class="form-check-input" type="checkbox" value="" id="whitecheck">
            <label class="form-check-label" for="flexCheckDefault">White List</label>
          
              <input style="margin-left: 55%;" id="search-input" type="search" id="form1" placeholder="Search..." class="form-check-input" />
              <label class="form-label" for="form1"></label>
              <button id="search-button" type="button" class="btn btn-primary"><i class="fas fa-search"></i> </button>
            
          </div>

         
           
        <div class="box-body">
          <div class="box">
            <div class="box-header with-border">
              <table class="table table-striped">
                <thead style="background-color: black; color: white; " class="thead-dark">
                  <tr>
                    <th scope="col">ID</th>
                    <th scope="col">IP</th>
                    <th scope="col">HASH</th>
                    <th scope="col">URL</th>
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
        </div>

      </div>
      <!-- /.box -->

    </section> <!-- /.content -->


  </div>
  <!-- /.content-wrapper -->