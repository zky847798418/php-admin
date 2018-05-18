<?php


$conn =new mysqli("mysql.hostinger.com.hk", "u417130694_admin", "666666") or die("error");
mysqli_select_db( $conn, 'u417130694_news' );
mysqli_query($conn , "set names utf8"); //使用utf-8中文编码;
// 检测连接
if ($conn->connect_error) {
    die("error");
}
?>