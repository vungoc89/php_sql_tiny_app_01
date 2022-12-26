<?php
require 'connect_db.php';
require 'func_help.php';
?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Bai 3: Quan ly member</title>
    </head>
    <style>
        table, th, td{
            border: 1px solid black;
        }
        #user-info{
            border: 1px solid black;
            width: 700px;
            margin: 0 auto;
            padding: 25px;
        }
        #user-info table{
            
            margin: 10px auto 0 auto;  
            text-align: center;
        }
        #user-info h1{
            text-align: center;
        }
        
    </style>
    <body>
         <?php 
         $result = mysqli_query($conn, "select * from tbl_users");
         mysqli_close($conn);
//         while($row = mysqli_fetch_array($result)){
//             print_arr($row);
//         }
         ?>
        <div id="user-info">
            <a href="./create_user.php?action=create">Add new user</a>
            <table id="user-listing" style="width:700px">
                <tr>
                    <td>Username</td>
                    <td>Status</td>
                    <td>Last update</td>
                    <td>Create time</td>
                    <td>Edit</td>
                    <td>Delete</td>
                </tr>
                <?php
                while($user = mysqli_fetch_array($result)){
                ?>
                <tr>
                    <td><?= $user['username'] ?></td>
                    <td><?= $user['status'] == 1 ? "Actived" : "Blocked" ?></td>
                    <td><?= date('d/m/Y H:i', $user['last_updated']) ?></td>
                    <td><?= date('d/m/Y H:i', $user['created_time']) ?></td>
                    <!--<td><a href="./edit_user.php?id=<?= $user['id'] ?>">Edit</a></td>-->
                    <td><a href="./edit_user.php?id=<?= $user['id'] ?>">Edit</a></td>
                    <td><a href="./delete_user.php?id=<?= $user['id'] ?>">Delete</a></td>
                   
                </tr>
                <?php
                }
                ?>
            </table>
        </div>
        
        <a href="./db_ui_create.php">Create a database</a>
    </body>
</html>
         

