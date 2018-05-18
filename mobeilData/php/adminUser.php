<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2018/1/15
 * Time: 20:37
 */
header("Access-Control-Allow-Origin: http://zky.16mb.com");
// 响应类型
header("Access-Control-Allow-Methods:POST");
// 响应头设置
header("Access-Control-Allow-Headers:x-requested-with,content-type");
include ("conn.php");
// 定义变量并默认设置为空值

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    $username = test_input($_POST['name']);
    $password = test_input($_POST['password']);
}

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
$sql = "SELECT username, password FROM user";
$result = $conn->query($sql);

$row = mysqli_fetch_assoc($result);
if($username===$row["username"]&&$password===$row["password"]){
    echo 'success';
}else{
    echo 'error';
}
$conn->close();

