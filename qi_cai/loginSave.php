<?php

//包含数据库操作类
include  "inc/DbClass.php";
//接收用户名、密码
$userName=$_POST["userName"];
$passWord=$_POST["passWord"];
var_dump($_SESSION["v_ckstr"]);
$VCode=$_POST["VCode"];
$_SESSION['id'] = $_POST["id"];
$_SESSION['userName'] = $userName;


if ($VCode!=$_SESSION["v_ckstr"]) {
    echo "<script> alert('验证错误!');window.history.back();</script>";
}
//做条SQL语句，并执行
$sql="select * from userinfo where userName='$userName'  and  passWord='$passWord'";
$result=$db->db_select_oneRow($sql);

//判断成功？ 成功：提示，跳转到主页。  失败：提示用户名或密码错。后退
if($result){
    echo "<script> alert('登录成功！');  window.location.href='index.php'; </script>";
}else{
    echo "<script> alert('用户名或密码错！'); window.history.back(); </script>";
}