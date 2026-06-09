<?php
header("Content-Type:application/json");
header("Access-Control-Allow-Origin:*");

// MySQL 数据库信息（你云端服务器的信息）
$host = "localhost";
$user = "root";
$pwd  = "你的数据库密码";
$db   = "xiyu_drama";

$conn = new mysqli($host,$user,$pwd,$db);
$conn->set_charset("utf8");

$action = $_GET["action"];

// 获取话剧列表
if($action=="list"){
    $res = $conn->query("SELECT * FROM dramas");
    $list = [];
    while($row = $res->fetch_assoc()){
        $list[] = $row;
    }
    echo json_encode($list);
}

// 用户登录
if($action=="login"){
    $user = $_POST["username"];
    $pwd = md5($_POST["password"]);
    $r = $conn->query("SELECT * FROM users WHERE username='$user' AND password='$pwd'");
    echo json_encode($r->num_rows>1 ? ["code"=>1] : ["code"=>0]);
}
?>