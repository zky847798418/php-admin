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
    $select = array_map("test_input",$_POST['select']);
//    echo json_encode($select);
}

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if(is_array($select)){
    $ids = implode(',',$select);
    $sql ="delete from message where id in($ids)";
    $retval = mysqli_query( $conn, $sql );
    if(! $retval ) {
        die('error');
    }else{
        echo 'success';
    }
}
$conn->close();
