<?php

$dMessage = "";
$dMessageType = "";

 if(isset($_POST['add_member_database'])){

        if(isset($_POST['id'])) {

            if(!empty($_POST['password'])) $nPassword = ", password = '".md5($_POST['password'])."' "; else  $nPassword = "";  
            $query = dbQuery("UPDATE accounts SET username = '".$_POST['username']."', name = '".$_POST['name']."',surname = '".$_POST['surname']."', email = '".$_POST['email']."',authorization = '".$_POST['authorization']."' ".$nPassword." WHERE id = '".$_POST['id']."';");

            $query = explode(":",$query);
            if($query[0] == "ok") {
                $dMessage = "Staff Successfully Organized.";
                $dMessageType = "callout-success";  
            }  else {
                $dMessage = "An error occurred while Editing Staff.".$query[1][2];
                $dMessageType = "callout-danger";  
            }
        } else {

            $query = dbQuery("INSERT INTO accounts (username,name,surname,password,email,authorization) values('".$_POST['username']."','".$_POST['name']."','".$_POST['surname']."','".md5($_POST['password'])."','".$_POST['email']."','".$_POST['authorization']."' );");

            $query = explode(":",$query);
            if($query[0] == "ok") {
                $dMessage = "Staff Added Successfully.";
                $dMessageType = "callout-success"; 
            }  else {
                $dMessage = "An error occurred while adding staff.".$query[1][2];
                $dMessageType = "callout-danger"; 
            }

       

        }
  }

if(isset($_GET['act']) and $_GET['act'] == "edit" and isset($_GET['id']) > 0){
     $accountData = dbPrepare("SELECT * FROM accounts where id = ?",array($_GET['id']));
     $accountData =$accountData->fetch();
  }
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->

    <section class="content-header">
      <h1>
       Accounts Action
      </h1>
    </section>    <!-- Main content -->


    <section class="content">

<!-- Default box -->
<div class="box">
  <div class="box-header with-border">

<!--  BEGIN CONTENT AREA  -->
<div id="content" class="main-content">
            <div class="layout-px-spacing">
           
            <div class="mb-3">

    <?php if(!empty($dMessage)){?>
            <div class="callout <?=$dMessageType?>">
                <h4><?=$dMessage?></h4>
            </div>
    <?php }?>  


                    <form action="admin.php?page=accountsAddMember<?=(!empty($accountData['id']))?'&act=edit&id='.$accountData['id']:''?>" name="act" method="POST" >
                      <label for="formFile" class="form-label">Username</label>
                      <input class="form-control" type="text" value="<?=(!empty($accountData['username']))?$accountData['username']:''?>" name="username">
                      <label for="formFile" class="form-label">Password</label>
                      <input class="form-control" type="password" value="<?=(!empty($accountData['Password']))?$accountData['Password']:''?>" name="Password">
                      <label for="formFile" class="form-label">Name</label>
                      <input class="form-control" type="text" value="<?=(!empty($accountData['name']))?$accountData['name']:''?>" name="name">
                      <label for="formFile" class="form-label">Surname</label>
                      <input class="form-control" type="text" value="<?=(!empty($accountData['surname']))?$accountData['surname']:''?>" name="surname">
                      <label for="formFile" class="form-label">email</label>
                      <input class="form-control" type="text" value="<?=(!empty($accountData['email']))?$accountData['email']:''?>" name="email">
                      <label for="formFile" class="form-label">authorization</label>
                      <select name="authorization" class="form-control" > 
                          <option value="2" <?=(!empty($accountData['authorization']) and $accountData['authorization']==2)?'selected':''?>>Admin</option> 
                          <option value="1" <?=(!empty($accountData['authorization']) and $accountData['authorization']==1)?'selected':''?>>Mod</option> 
                          <option value="0"<?=(!empty($accountData['authorization']) and $accountData['authorization']==0)?'selected':''?>>Member</option>
                      </select><br />
                      <?=(!empty($accountData['id']))?'<input type="hidden" name="id" value="'.$accountData['id'].'" hidden="hidden" /> ':''?> 
                      <button style="margin-top: 15px;" type="submit" name="add_member_database" class="btn btn-primary">Submit</button>
                  </form>
                </div>

            </div>
        </div>
        <!--  END CONTENT AREA  -->


  </div>

  <!-- /.box-footer-->
</div>
<!-- /.box -->

</section>    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->