<?php include("config.php");

 // die(phpinfo());   

if(isset($_SESSION['gradUser'])!=''){  header("Location:admin.php"); }

$message = '';
$p = "";

if(isset($_POST) && isset($_POST['username'])!='' && isset($_POST['password'])!=''){

    $username=$_POST['username'];
    $password=$_POST['password'];

 $sql=$dbh->prepare("SELECT * FROM accounts WHERE username=?");
 $sql->execute(array($username));
 while($r=$sql->fetch()){
  $p=$r['password'];
  $id=$r['id'];
 }

 $md5Password = md5($password);
 $message = "";
 if($p==$md5Password){
  $_SESSION['gradUser']=$username;
  $_SESSION['gradPass']=$md5Password;
  redirecLink("admin.php");
  $message = '
  <div class="alert alert-success mb-4" role="alert">
    <strong>Successfull login!</button>
    </div>'.redirecLink("admin.php");
 }else{
  $message = '
  <div class="alert alert-danger mb-4" role="alert">
    <strong>Wrong Login! </button>
    </div>';
 }
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title> AYBU | GP </title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome used before-->
  <!--<link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">-->

  <script src="plugins/4f34eb3513.js" crossorigin="anonymous"></script>
  <!-- Ionicons -->
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="plugins//html5shiv.min.js"></script>
  <script src="plugins//respond.min.js"></script>
  <![endif]-->


</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
  <a href="index.php" class="logo">
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>G-AYBU</b> PROJECT</span>
    </a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg"><?php echo $message; ?></p>

    <form method="post" name="login" action="">
      <div class="form-group has-feedback">
        <input type="text" name="username" class="form-control" placeholder="username">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" name="password" class="form-control" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
        </div>
        <!-- /.col -->
      </div>
    </form>
  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->
<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });
  });
</script>
</body>
</html>