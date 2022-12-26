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
print_arr($result);
        $user = mysqli_fetch_assoc($result);
        
        $error = [];
        $success = [];
//        if (isset($_GET['action']) && $_GET['action'] == 'edit') {
        if (isset($_POST['btn_del'])) {


                $result = mysqli_query($conn, "delete from tbl_users where id = '$id'");
//                print_arr($result);
//               
//                 $result = mysqli_query($conn, "update tbl_users set username = '$username', password = '$password', last_updated=" . time() . "  where id = '$id'");
//                $result = mysqli_query($conn, "update tbl_users set username = '$username' where id = '$id'");
                if (mysqli_affected_rows($conn) > 0) {

                    $success['username'] = "username delete success!";
                    
                } else {
                    $error['username'] = "username delete fail!" . mysqli_errno($conn);
                }
//                mysqli_close($conn);
            }
        ?>
        <div id="update_user" class="box-content">
            <h1>Confirm delete account <?= $user['username'] ?> !</h1>
            <form action="" method="post" autocomplete="off">
                <input type="submit" name="btn_del" value="Delete">
             <?php
                    if(!empty($success['username'])){
                ?>
                <div id="error_notice">
                    <!--Challenge: chuyen doan thong bao nay thanh popup(dung jquery)-->
                    <h1>Report</h1>
                    <p class="success">You delete <?= $user['username'] ?> successfully</p>
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
       
    </body>
</html>



