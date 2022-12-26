<?php
require 'func_help.php';
$host = "localhost";
$user = "root";
$password = "";
//$database = "demo_db_andn";
$conn = mysqli_connect($host, $user, $password);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
} else {
    echo "Connect xampp success!"; //ok
}

$success_db = [];
$error_db = [];
$list_db = [];
//https://stackoverflow.com/questions/9965348/php-get-list-of-databases-names
//https://stackoverflow.com/questions/15218277/list-mysql-databases-using-php
//Muc dich show_list_of_db la de bat loi name of database existed
//vi vs func thi khi bat loi mysqli_error($conn) chỉ in ra lỗi set sẵn của chương trình chứ ko bắt được lỗi cần in ra(?)
function show_list_of_db(){
    global $conn;
//    global $list_db;
    
    $db = mysqli_query($conn, "show databases");
    while($data = mysqli_fetch_assoc($db))
    {
//        print_arr($data);
//        echo"<br>";
//        array_push($list_db, $data);
        $list_db2[] = $data;
    }
//    print_arr($list_db);
    return $list_db2;//ok
}
//https://fuelingphp.com/how-to-copy-array-in-php/
// print_arr($list_db);
$list_db = show_list_of_db(); //copy array
//print_arr($list_db);//ok

//PHP Create a MySQL Database: https://www.w3schools.com/php/php_mysql_create.asp
function create_name_of_db($dbname) { //ok
    global $success_db;
    global $error_db;
    global $conn;
//    global $host, $user, $password;
//    $link = mysqli_connect($host, $user, $password);
    $sql = "create database $dbname";
    $result = mysqli_query($conn, $sql);

    if ($result) {
//        echo "Database created successfully";
        $success_db['success_db_create'] = "Database $dbname created successfully";
    } 
    //Neu xet db_name existed thi ko dung else nay nua
    else {
        ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
//        echo "Error creating database: " . mysqli_error($conn);
//        $error_db['error_db_create'] = "Error creating database: " . mysqli_error($conn);
//        $error_db['error_db_create'] = "Database $dbname create failed! Database existed!"; 
    }

echo mysqli_get_server_info($conn);
    mysqli_close($conn);
}

//https://www.php.net/manual/en/mysqli.set-charset.php
function create_collation_of_db($dbname, $db_collation) {
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    $link = mysqli_connect($host, $user, $password, $dbname);
    if (!$link) {
        die("Connection failed: " . mysqli_connect_error());
    }
    mysqli_set_charset($link, $db_collation);
    mysqli_close($link);
//    printf("Current character set: %s\n", mysqli_character_set_name($link));
}

/**
  CREATE TABLE `demo_create_db01`.`tbl_one_test` () ENGINE = InnoDB;
 */
function create_table_of_db($dbname, $tablename) {
    $link = mysqli_connect($host, $user, $password, $dbname);
    if (!$link) {
        die("Connection failed: " . mysqli_connect_error());
    }
    $sql = "create table `$dbname`.`$tablename` () ENGINE = InnoDB;";
    $result = mysqli_query($link, $sql);
    if ($result) {
        echo "Table {$dbname} created successfully";
    } else {
        echo "Error creating table: " . mysqli_error($conn);
    }
    
    print_arr(mysqli_error($conn));
    mysqli_close($conn);
}
//------------------------------
show_list_of_db();
//--------> https://stackoverflow.com/questions/15218277/list-mysql-databases-using-php
if (isset($_POST['btndb_create'])) {
     $db_name = $_POST['db_name_ip'];
    if (empty($db_name)) {
        $error_db['db_name'] = "Db name cannot empty!";
    }
//    foreach ($list_db as $key => $db) {
//        if($db_name == $db['Database']){
//            echo "DB is {$db['Database']} existed<br>";
//            $error_db['db_name'] = "Db name <strong>{$db['Database']}</strong> is existed!";
//        }
//    }
    if(empty($error_db)){
    create_name_of_db($db_name);
//    echo "$db_name";
    }
}
?>
<style>
    p.error{
        color: red;
    }
    p.success{
        color: green;
    }
</style>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>DB Creator App</title>
    </head>
    <body>
        <h1>Database Creator App</h1>
        <form action="" method="post">
            <h2>Create a database</h2>
            <label for="">DB Name: </label>
            <input type="text" name="db_name_ip" value=""><br><br>
            <input type="submit" name="btndb_create" value="Create db">
            
            <?php if (!empty($success_db['success_db_create'])) echo"<p class='success'>{$success_db['success_db_create']} </p>"; ?>
            <?php if (!empty($error_db['error_db_create'])) echo"<p class='error'>{$error_db['error_db_create']} </p>"; ?>
            <?php if (!empty($error_db['db_name'])) echo"<p class='error'>  {$error_db['db_name']}</p>"; ?>
        </form>
        <form action="" method="post">

            <label for="" name="db_name" value="">DB length/values of row: </label>
            <select name="db_type" id="">
                <option value="INT">INT</option>
                <option value="TINYINT">TINYINT</option>
                <option value="CHAR">CHAR</option>
                <option value="VARCHAR">VARCHAR</option>
                <option value="ENUM">ENUM</option>
                <option value="DATE">DATE</option>
                <option value="DATETIME">DATETIME</option>
                <option value="TIMESTAMP">TIMESTAMP</option>
            </select><br><br>
            <label for="">DB length/values: </label>
            <input type="number" min="1" max="11" name="db_row_values" value=""><br><br>

            <label for="">DB column amount: </label>
            <input type="db_number" min="1" max="1024" name="db_col_num" value=""><br><br>
            <label for="">DB Default: </label>
            <select name="" id="">
                <option value="None" selected="selected">None</option>
                <option value="As defined:">As defined:</option>
                <option value="NULL">NULL</option>
                <option value="CURRENT_TIMESTAMP">CURRENT_TIMESTAMP</option>
            </select><br><br>
            <hr>
            <label for="">DB Collation: </label>
            <select name="db_collation" id="">
                <option value="" disabled>Collation</option>
                <option value="utf8_general_ci">utf8_general_ci</option>
                <option value="utf8mb4_general_ci" selected="selected">utf8mb4_general_ci</option>
                <option value="utf8_unicode_ci">utf8_unicode_ci</option>
                <option value="utf8mb4_vietnamese_ci">utf8mb4_vietnamese_ci</option>
            </select>
            <br><br>
            <a href="index.php">Go back index</a>
        </form>
    </body>
</html>