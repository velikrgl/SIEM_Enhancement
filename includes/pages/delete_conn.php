<head>

   
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>

<?php
$conn = new mysqli('localhost', 'root', '', 'gradproj');


if (isset($_POST['delete'])) {

    $id = $_POST['id'];
    $sql = "DELETE FROM connections WHERE id=$id";
    $result = $conn->query($sql);
   
    
}
