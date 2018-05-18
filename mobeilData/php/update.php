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
    $update = $_POST['new'];
    foreach ($update as $key => $value) {
        $new[$key] = test_input($value);
    }
//    echo json_encode($new);
}

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
date_default_timezone_set('PRC');
$now=date("y-m-d H:i:s");
if(is_array($new)){
    $sql ="UPDATE message SET fname='$new[fname]',sex='$new[sex]',phone='$new[phone]',address='$new[address]',detail='$new[detail]',update_time='$now'
      WHERE id=$new[id]";
    $retval = mysqli_query( $conn, $sql );
    if(! $retval ) {
        die('error');
    }else{
        echo 'success';
    }
}
$conn->close();
