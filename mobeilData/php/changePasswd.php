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
    $password = test_input($_POST['agoPasswd']);
    $newPassword = test_input($_POST['passwd']);
}

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
$sql = "SELECT id, username, password FROM user";
$result = $conn->query($sql);

$row = mysqli_fetch_assoc($result);
if($username===$row["username"]&&$password===$row["password"]){
    $sql2 = "UPDATE user
        SET password=$newPassword
        WHERE username='admin' AND id=1";
    $retval = mysqli_query( $conn, $sql2 );
    if(!$retval ) {
        echo 'error';
    } else {
        echo 'success';
    }
}else{
    echo 'error';
}
$conn->close();
