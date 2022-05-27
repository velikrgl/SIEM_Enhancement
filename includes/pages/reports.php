<?php

$filter = "ALL";
$fNum = 4;
if (isset($_GET['filter']) && $_GET['filter'] == 1) {
    $filter = "IP";
    $fNum = 1;
} else if (isset($_GET['filter']) && $_GET['filter'] == 2) {
    $filter = "HASH";
    $fNum = 2;
} else if (isset($_GET['filter']) && $_GET['filter'] == 3) {
    $filter = "URL";
    $fNum = 3;
} else if (isset($_GET['filter']) && $_GET['filter'] == 4) {
    $filter = "ALL";
    $fNum = 4;
}

?>

<?php
if (isset($_POST['fetch_scannedDB'])) {
    $conn = new mysqli('localhost', 'root', '', 'gradproj');

    $query  = "SELECT * FROM db_status where info_type=1";
    $ip_list_db_status = array();
    $size_dbstatus = 0;
    $result = mysqli_query($conn, $query);

    $scanned_arr = array();
    $count_scanned = 0;

    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            //getting values

            array_push($ip_list_db_status, $row['ip_hash_url']);
            $scanned_arr[$count_scanned++] = $row['id'];
            $size_dbstatus = count($ip_list_db_status);
        }
    }

    //print_r($scanned_arr);
    $query2 = "SELECT remote_ip as ip_siem_list FROM siem_logs UNION SELECT hop_ip FROM siem_logs UNION SELECT source_ip FROM siem_logs";
    $ip_list_siemlogs = array();
    $size_siemlogs = 0;
    $result_db = mysqli_query($conn, $query2);

    if ($result_db->num_rows > 0) {
        // output data of each row
        while ($row2 = $result_db->fetch_assoc()) {
            //getting values
            array_push($ip_list_siemlogs, $row2['ip_siem_list']);
        }
        $size_siemlogs = count($ip_list_siemlogs);
    }

    $last_arr = array();
    $count_last = 0;

    for ($i = 0; $i < $size_dbstatus; $i++) {
        for ($j = 0; $j < $size_siemlogs; $j++) {

            if ($ip_list_db_status[$i] == $ip_list_siemlogs[$j]) {

                $last_arr[$count_last++] = $scanned_arr[$i];
            }
        }
    }
    $size_of_lastarr = 4; //count($last_arr);
    $t = time();
    $scanned_date = (date("Y-m-d", $t));

    for ($cnt = 0; $cnt < $size_of_lastarr; $cnt++) {

        $id_of_last = $last_arr[$cnt];
        $sql_last = "SELECT * FROM db_status WHERE id='$id_of_last'";
        $result_last = mysqli_query($conn, $sql_last);
        $row_last = $result_last->fetch_assoc();

        $source = $row_last['ip_hash_url'];

        //     $ch = curl_init('http://ip-api.com/json/'.$source.'?lang=en');                                                                     
        //     curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
        //     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
        //     curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
        //     'Content-Type: application/json'                                                                                
        // ));
        // $result = curl_exec($ch);

        // $data = json_decode($result);

        // $scanned_country =$data->country;
        // $scanned_city=$data->regionName;

        $scanned_type = $row_last['info_type'];

        $status = $row_last['blackorWhite'];
        $connectionID = $row_last['connectionID'];

        if ($connectionID == 2) {
            $connectionID = "USOM";
        }

        $sql_last2 = "INSERT INTO  scanned_db ( scanned_source ,  scanned_type ,  scanned_time ,  status ,  which_api_src ,  blocked ,  country ,  city ) 
        VALUES ('$source','$scanned_type','$scanned_date','$status','$connectionID','0','TURKEY','ISTANBUL')";
        $result_last2 = mysqli_query($conn, $sql_last2);


        
    }
        $source_ip = "192.168.15.137";
        $bad_ip = "192.168.15.132";

        echo shell_exec("C:\\PsExec.exe  -s \\\\$source_ip -u win10dev -p aybutest C:\\Windows\\System32\\WindowsPowerShell\\v1.0\\powershell.exe New-NetFirewallRule -RemoteAddress $bad_ip -DisplayName AYBU -Direction Outbound -Profile Any -Action Block");

        shell_exec("C:\\PsExec.exe  -s \\\\$source_ip -u win10dev -p aybutest C:\\Windows\\System32\\WindowsPowerShell\\v1.0\\powershell.exe New-NetFirewallRule -RemoteAddress $bad_ip -DisplayName AYBU -Direction Inbound -Profile Any  -Action Block");
}


?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->

    <section class="content-header">
        <h1>
            Reports
        </h1>
        <br /><br />
        <div class="btn-group">
            <a href="admin.php?page=reports&filter=4" type="button" <?= ((isset($_GET['filter']) && $_GET['filter'] == 4) || !isset($_GET['filter'])) ? 'class="btn btn-danger"' : 'class="btn btn-default"'; ?>>ALL</a>
            <a href="admin.php?page=reports&filter=1" type="button" <?= (isset($_GET['filter']) && $_GET['filter'] == 1) ? 'class="btn btn-danger"' : 'class="btn btn-default"'; ?>>IP</a>
            <a href="admin.php?page=reports&filter=2" type="button" <?= (isset($_GET['filter']) && $_GET['filter'] == 2) ? 'class="btn btn-danger"' : 'class="btn btn-default"'; ?>>HASH</a>
            <a href="admin.php?page=reports&filter=3" type="button" <?= (isset($_GET['filter']) && $_GET['filter'] == 3) ? 'class="btn btn-danger"' : 'class="btn btn-default"'; ?>>URL</a>


        </div>
        <form action="admin.php?page=reports&filter=4" method="POST">
            <button style="float: right; margin-top: -35px;  color: darkslategrey; font-weight: bolder; " name="fetch_scannedDB" type="submit" class="btn btn-warning"><i style="margin-right: 10px;" class="fa-solid fa-arrows-rotate fa-xl"></i>Fetch Data Now</button>
        </form>

    </section> <!-- Main content -->


    <section class="content">

        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">

                <!--  BEGIN CONTENT AREA  -->
                <div id="content" class="main-content">
                    <div class="layout-px-spacing">

                        <div class="row layout-top-spacing">

                            <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                                <div class="widget-content widget-content-area br-6">


                                    <div class="table-responsive mb-4 mt-4">
                                        <table id="html5-extension" class="table table-bordered table-striped mb-4" style="width:100%">
                                            <thead class="thead-dark">
                                                <tr>
                                                    <th><?php echo $filter; ?></th>
                                                    <th>time</th>
                                                    <th>status</th>
                                                    <th>which_api_src</th>
                                                    <th>blocked</th>
                                                    <th>country</th>
                                                    <th>city</th>
                                                </tr>
                                            </thead>

                                        </table>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
                <!--  END CONTENT AREA  -->

                <script>
                    window.onload = function() {
                        var filterBtnNum = 0;

                        $('#html5-extension').DataTable({
                            //dom: 'Bfrtip',
                            dom: 'B<"text-right aligned eight wide column"l>frtip',
                            buttons: {
                                buttons: [{
                                        extend: 'excel',
                                        className: 'btn btn-success mb-2',
                                        exportOptions: {
                                            columns: ':visible'
                                        }
                                    },
                                    {
                                        extend: 'pdf',
                                        className: 'btn btn-danger mb-2',
                                        exportOptions: {
                                            columns: ':visible'
                                        }
                                    },
                                    {
                                        extend: 'print',
                                        className: 'btn btn-primary mb-2',
                                        text: 'Print',
                                        exportOptions: {
                                            columns: ':visible'
                                        }
                                    }

                                ],
                                columnDefs: [{
                                    targets: -1,
                                    visible: false
                                }]
                            },
                            "oLanguage": {
                                "sEmptyTable": "Tabloda veri yok",
                                "oPaginate": {
                                    "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>',
                                    "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>'
                                },
                                "sInfo": " _PAGE_ / _PAGES_",
                                "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
                                "sSearchPlaceholder": "Ara...",
                                "sInfoFiltered": "(Toplam: _MAX_)",
                                "sLengthMenu": "Liste :  _MENU_",
                                "sProcessing": '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" style="margin: auto; background: none; display: block; shape-rendering: auto;" width="60px" height="60px" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid"><circle cx="84" cy="50" r="10" fill="#343a40"><animate attributeName="r" repeatCount="indefinite" dur="0.25s" calcMode="spline" keyTimes="0;1" values="12;0" keySplines="0 0.5 0.5 1" begin="0s"></animate><animate attributeName="fill" repeatCount="indefinite" dur="1s" calcMode="discrete" keyTimes="0;0.25;0.5;0.75;1" values="#343a40;#efb906;#343a40;#efb906;#343a40" begin="0s"></animate></circle><circle cx="16" cy="50" r="10" fill="#343a40">  <animate attributeName="r" repeatCount="indefinite" dur="1s" calcMode="spline" keyTimes="0;0.25;0.5;0.75;1" values="0;0;12;12;12" keySplines="0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1" begin="0s"></animate>  <animate attributeName="cx" repeatCount="indefinite" dur="1s" calcMode="spline" keyTimes="0;0.25;0.5;0.75;1" values="16;16;16;50;84" keySplines="0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1" begin="0s"></animate></circle><circle cx="50" cy="50" r="10" fill="#efb906">  <animate attributeName="r" repeatCount="indefinite" dur="1s" calcMode="spline" keyTimes="0;0.25;0.5;0.75;1" values="0;0;12;12;12" keySplines="0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1" begin="-0.25s"></animate>  <animate attributeName="cx" repeatCount="indefinite" dur="1s" calcMode="spline" keyTimes="0;0.25;0.5;0.75;1" values="16;16;16;50;84" keySplines="0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1" begin="-0.25s"></animate></circle><circle cx="84" cy="50" r="10" fill="#343a40">  <animate attributeName="r" repeatCount="indefinite" dur="1s" calcMode="spline" keyTimes="0;0.25;0.5;0.75;1" values="0;0;12;12;12" keySplines="0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1" begin="-0.5s"></animate>  <animate attributeName="cx" repeatCount="indefinite" dur="1s" calcMode="spline" keyTimes="0;0.25;0.5;0.75;1" values="16;16;16;50;84" keySplines="0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1" begin="-0.5s"></animate></circle><circle cx="16" cy="50" r="10" fill="#efb906">  <animate attributeName="r" repeatCount="indefinite" dur="1s" calcMode="spline" keyTimes="0;0.25;0.5;0.75;1" values="0;0;12;12;12" keySplines="0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1" begin="-0.75s"></animate>  <animate attributeName="cx" repeatCount="indefinite" dur="1s" calcMode="spline" keyTimes="0;0.25;0.5;0.75;1" values="16;16;16;50;84" keySplines="0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1" begin="-0.75s"></animate></circle></svg>',
                            },
                            "stripeClasses": [],
                            "lengthMenu": [
                                [10, 25, 50],
                                [10, 25, 50]
                            ],
                            "pageLength": 10,
                            "processing": true,
                            "serverSide": true,
                            "ajax": "getData.php?db=reports&filter=<?php echo $fNum; ?>",
                            "order": [
                                [2, "desc"]
                            ],
                            "searching": true,


                        });

                    };
                </script>


            </div>

            <!-- /.box-footer-->
        </div>
        <!-- /.box -->

    </section> <!-- /.content -->
</div>
<!-- /.content-wrapper -->