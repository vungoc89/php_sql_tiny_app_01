<?php
require 'connect_db.php';
require 'func_help.php';

//print_arr($_GET);
//print_arr($_POST);
/**
 * ----------- VS $_GET
  Array
  (
  [action] => create
  )
 * 
 * ------- VS $_POST
  Array
  (
  [username] => user01
  [password] => 123
  [btn_submit] => Create user
  )

 */
?>
<?php
$error = [];
$success = [];
//isset($_POST['btn_available']) &&
if (isset($_GET['action']) && $_GET['action'] == 'create') {
    if (isset($_POST['btn_submit'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        if (empty($username)){
            $error['username'] = "Username cannot empty!";
        } else {
            $username = mysqli_real_escape_string($conn, $username);
            echo "username after escapte = {$username}"; //ok
            $result = mysqli_query($conn, "SELECT username FROM tbl_users WHERE username = '$username'");
//            print_arr($res);
//            if (isset($_POST['btn_available'])) {
                if (mysqli_num_rows($result) > 0) {
                    $error['user_existed'] = "Username existed!";
                } else {
                    $success['user_available'] = "Username is available";
                }
        }

        if (empty($password)) {
            $error['password'] = "Password cannot empty!";
        }
        
        if (empty($error)) {
            $password = password_hash($password, PASSWORD_BCRYPT);
            $result = mysqli_query($conn, "insert into tbl_users(`username`, `password`,`last_updated`, `created_time`) values('{$username}', '{$password}'," . time() . ", " . time() . " )");
            if ($result) {
               
                $success['user_success'] = "Insert success";
            } else {
                $error['user_error'] = "Insert failed" . mysqli_errno($conn);
            }
            mysqli_close($conn);
        }
    }
}
?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Create new user</title>
    </head>
    <style>
        .box-content{
            margin: 0 auto;
            width: 800px;
            border: 1px solid #ccc;
            text-align: center;
            padding: 20px;
        }
        #create_user form{
            width: 200px;
            margin: 40px auto;
        }

        #create_user form input{
            margin: 5px 0;
        }
        p.error{
            color: red;
        }
        p.available, p.success{
            color: green;
        }

       input {
  overflow: hidden;  
  display: inline-block;
  box-sizing: border-box;
}
    </style>
    <body>
        <div id="create_user" class="box-content">
            <h1>Create new user</h1>
            <form action="./create_user.php?action=create" method="post" autocomplete="off">
                <label for="">Username</label>
                
                        
                        <input type="text" name="username" value="<?php if (!empty($username)) echo "{$username}" ?>">

                    <?php if (!empty($error['username'])) echo"<p class='error'>{$error['username']}</p>" ?>
                    <?php if (!empty($error['user_existed'])) echo"<p class='error'>{$error['user_existed']}</p>" ?>
                    <?php if (!empty($success['user_available'])) echo"<p class='available'>{$success['user_available']}</p>" ?>
              
                <!--<div class="clear"></div>-->
                <br>
                <label for="">Password</label>
                <input type="password" name="password" value="">
                <?php if (!empty($error['password'])) echo"<p class='error'>{$error['password']}</p>" ?>
                <br>
                <input type="submit" value="Create user" name="btn_submit">
               
                <?php
                    if(!empty($success['user_success'])){
                ?>
                <div id="error_notice">
                    <!--Challenge: chuyen doan thong bao nay thanh popup(dung jquery)-->
                    <h1>Report</h1>
                    <p class="success">You created <?= $username ?> successfully</p>
                    <!--<a href="./index.php">Come back List user</a>--> 
                    <!--<a href="./create_user.php">Come back Create user</a>-->
                </div>
                <?php 
                    }
                ?>
            </form>
            
            <a href="./index.php">Come back List user</a>
        </div>

    </body>
</html>
