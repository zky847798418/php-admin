<?php
include ("conn.php");
// 定义变量并默认设置为空值
$fname = $fgender = $fnumber = $ftext = $fman = "";

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    $fname = test_input($_POST["fname"]);
    $ftext = test_input($_POST["ftext"]);
    $fnumber = test_input($_POST["fnumber"]);
    $fgender = test_input($_POST["fgender"]);
    $fman = test_input($_POST["fman"]);
}

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
//echo $fname;
//echo $ftext;
//echo $fgender;
//echo $fnumber;
//echo $fman;

//if($fgender==="男"){
//    $sex=0;
//}
//if($fgender==="女"){
//    $sex=1;
//}

if((strlen($fname)== 0)|| (strlen($ftext) ==0) || (strlen($fman) ==0)){
    die('error');
}else{
    $sql = 'SELECT phone FROM message';

    $retval = mysqli_query( $conn, $sql );
    if(! $retval ) {
        die('error');
    }
    while($row = mysqli_fetch_array($retval, MYSQLI_ASSOC)) {
        if($row['phone']===$fnumber){
            die('errorCopy');
        }
    }

    $sql = "INSERT INTO message (fname, sex, phone, address,manSize,detail)
VALUES ('$fname', '$fgender', '$fnumber', '$ftext',$fman,'')";

    if (mysqli_multi_query($conn, $sql)) {
        echo "success";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}


mysqli_close($conn);
?>
