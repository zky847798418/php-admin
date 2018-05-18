<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2018/1/15
 * Time: 20:02
 */
header("Access-Control-Allow-Origin: http://zky.16mb.com");
// 响应类型
header("Access-Control-Allow-Methods:POST");
// 响应头设置
header("Access-Control-Allow-Headers:x-requested-with,content-type");
include ("conn.php");
$page = $pageSize = $category = "";

if ($_SERVER["REQUEST_METHOD"] == "GET")
{
    $page = test_input($_GET["page"]);
    $pagesize = test_input($_GET["limit"]);
    if(!empty($_GET["category"])){
        $category = test_input($_GET["category"]);
    }
}

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

$wherelist=array();
$wherelist[]=" id like '%".$category."%'";
$wherelist[]=" fname like '%".$category."%'";
$wherelist[]=" sex like '%".$category."%'";
$wherelist[]=" address like '%".$category."%'";
$wherelist[]=" detail like '%".$category."%'";
$wherelist[]=" create_time like '%".$category."%'";
$wherelist[]=" update_time like '%".$category."%'";

$where="";
if(count($wherelist)>0)
{
    $where=" where ".implode(' or ',$wherelist);
}


//1.获取数据表中总记录数
$sql="select * from message {$where}";
$result=$conn->query($sql);
$totalnum=$result->num_rows;

//echo json_encode($wherelist);
//echo $where;
$limit=" limit ".($page-1)*$pagesize.",$pagesize";
$sql1 = "select * from message {$where} {$limit}";//拼成一个完整的SQL语句



//$sql1="select * from message order by id asc";
$result1 = $conn->query($sql1);
if($result1->num_rows > 0) {
    /*数据集*/
    $lists=array();
    $i=0;
    while($row=$result1->fetch_assoc()){
        $num=(int)$row['id'];
        $sql2="select id from message where id<=$num";
        $result2 = $conn->query($sql2);
        $row['index'] = $result2->num_rows;
        $lists[$i]=$row;
        $i++;
    }
    echo json_encode(array('dataList'=>$lists,'dataLengthAll'=>$totalnum));
}else{
    echo json_encode(array('dataList'=>[],'dataLengthAll'=>$totalnum));
}

$result1->free_result();
//释放结果

$conn->close();