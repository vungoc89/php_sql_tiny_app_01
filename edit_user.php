<?php
require 'connect_db.php';
require 'func_help.php';
?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Edit (password) user</title>
    </head>
    <style>
        /*        .box-content{
                    margin: 0 auto;
                    width: 800px;
                    border: 1px solid #ccc;
                    text-align: center;
                    padding: 20px;
                }*/
        table, th, td{
            border: 1px solid black;
        }
        #update_user{
            border: 1px solid black;
            width: 700px;
            margin: 0 auto;
            padding: 25px;
        }
        #update_user table{

            margin: 10px auto 0 auto;  
            text-align: center;
        }
        #update_user h1{
            text-align: center;
        }
        p.error{
            color: red;
        }
        p.success{
            color: green;
        }
        input {
            overflow: hidden;  
            display: inline-block;
            box-sizing: border-box;
        }
    </style>
    <body>
        <?php
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
        }
        $result = mysqli_query($conn, "select * from tbl_users where id = '$id'");
//               var_dump($result);
//print_arr($result);
        $user = mysqli_fetch_assoc($result);
//        print_arr($user);
        $error = [];
        $success = [];
//        if (isset($_GET['action']) && $_GET['action'] == 'edit') {
        if (isset($_POST['btn_edit'])) {

            $user_id = $_POST['user_id'];
//            echo "uid = $user_id<br>";
//            if(!empty($_POST['status'])){
                
            $status = $_POST['status'];
//            echo "status = $status";
//            }
            $password = $_POST['password'];
            $username = $_POST['username'];

            if (empty($username)) {
                $error['username'] = "Username cannot empty!";
            }
            if (empty($password)) {
                $error['password'] = "Password cannot empty!";
            }

//            if (empty($status)) {
//                $error['status'] = "status cannot empty!";
//            }

//            echo "user_id 1= {$user_id}<br>"; //ok

            if (empty($error)) {
//                echo "Not have err<br>";
//                echo "user_id 2= {$_POST['user_id']}<br>";
//                echo "user_id 2= {$user_id}<br>";
//                echo "id trong empty error = {$id}<br>";
//                echo "pass = {$password}<br>";
//                    $status = $_POST['status'];
                $password = password_hash($password, PASSWORD_BCRYPT);
                $result = mysqli_query($conn, "update tbl_users set username = '$username', password = '$password', status = '$status', last_updated=" . time() . "  where id = '$user_id'");
//                $result = mysqli_query($conn, "update tbl_users set username = '$username',  status = '$status', last_updated=" . time() . "  where id = '$user_id'");
//                print_arr($result);
//               
//                 $result = mysqli_query($conn, "update tbl_users set username = '$username', password = '$password', last_updated=" . time() . "  where id = '$id'");
//                $result = mysqli_query($conn, "update tbl_users set username = '$username' where id = '$id'");
                if (mysqli_affected_rows($conn) > 0) {

                    $success['username'] = "username update success!";
                    $success['password'] = "Password update success!";
//                    $success['status'] = "Status update success!";
                } else {
                    $error['username'] = "username update fail!" . mysqli_errno($conn);
                    $error['password'] = "Password update fail!" . mysqli_errno($conn);
//                    $error['status'] = "Status update fail!" . mysqli_errno($conn);
                }
//                mysqli_close($conn);
            }
//            echo "user_id 3= {$user_id}<br>";
        }

//        $result = mysqli_query($conn, "select * from tbl_users where id = '$id'");
//        $user = mysqli_fetch_assoc($result);
//        echo "id = {$id} and user_id = {$user['id']}<br>";
//        var_dump($user['id']);
//        print_arr($user); //ok
//        mysqli_close($conn);
//        $status = [0=>"Blocked", 1=>"Actived"];
        ?>
        <div id="update_user" class="box-content">
            <h1>Edit (password) account <?= $user['username'] ?></h1>
            <form action="" method="post" autocomplete="off">
                <!--<form action="./edit_user.php?action=edit" method="post" autocomplete="off">-->
                <?php // echo "id 2 = {$id}<br>"; ?>
                <input type="hidden" name="user_id" value="<?= $user['id'] ?>">
                <?php // var_dump((int) ($user['id']));  ?>

                <input type="text" name="username" value="<?= $user['username'] ?>" placeholder="Reset username">
                <?php if (!empty($error['username'])) echo"<p class='error'>{$error['username']}</p>" ?>
                <?php if (!empty($success['username'])) echo"<p class='success'>{$success['username']}</p>" ?>

                <input type="password" name="password" value="" id="rstpass" placeholder="Reset password">
                <!--<input type="checkbox" onclick="myFunction()">Show Password-->
                <?php if (!empty($error['password'])) echo"<p class='error'>{$error['password']}</p>" ?>
                <?php if (!empty($success['password'])) echo"<p class='success'>{$success['password']}</p>" ?>

                <select name="status">
                    <option value="" disabled>--Chon Status--</option>
                   <?php if($user['status'] == 1) { ?>
                    <option value=1>Actived</option>
                    <option value=0>Blocked</option>
                   <?php }else{ ?>
                     <option value=0>Blocked</option>
                    <option value=1>Actived</option>
                   <?php } ?>
                </select>
                <?php // if (!empty($error['status'])) echo"<p class='error'>{$error['status']}</p>" ?>
                <?php // if (!empty($success['status'])) echo"<p class='success'>{$success['status']}</p>" ?>
                <br>
                <input type="submit" name="btn_edit" value="Edit">

                <?php
                if (!empty($success['username'])) {
                    ?>
                    <div id="error_notice">
                        <!--Challenge: chuyen doan thong bao nay thanh popup(dung jquery)-->
                        <h1>Report</h1>
                        <p class="success">You update <?= $username ?> successfully</p>
                        <!--<a href="./index.php">Come back List user</a>--> 
                        <!--<a href="./create_user.php">Come back Create user</a>-->
                    </div>
                    <?php
                }
                ?>
            </form>
            <a href="./index.php">Come back List user</a>
        </div>
        <?php // }   ?>
        <script>
            function myFunction() {
                var x = document.getElementById("rstpass");
                if (x.type === "password") {
                    x.type = "text";
                } else {
                    x.type = "password";
                }

            }
        </script>
    </body>
</html>



