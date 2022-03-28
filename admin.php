<?php

include("includes/sec.php");  
include("includes/header.php");


    if(isset($_GET['page']) and $_GET['page'] != "") {
        if(file_exists("includes/pages/".$_GET['page'].".php")) include("includes/pages/".$_GET['page'].".php"); else include("includes/pages/noPage.php");
    } else {
     include("includes/pages/admin.php");
    }

include("includes/footer.php");

?>