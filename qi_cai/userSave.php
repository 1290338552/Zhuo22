<?php
include "inc/Dbclass.php";

$action=$_GET["action"]; //动作是从地址栏（网址）传来，必须用GET接收

if ($action=="insert"){
    $userName=$_POST["userName"];
    $passWord=$_POST["passWord"];
    $phone=$_POST["phone"];
    $email=$_POST["email"];
    $birthday=$_POST["birthday"];
    $nationNo=$_POST["nationNo"];
    $sex=$_POST["sex"];
    $ArticleContent=$_POST["ArticleContent"];
    $BImgpath=$_POST["BImgpath"];
    $sql="INSERT INTO `userinfo`(`userName`, `passWord`, `phone`, `email`, `birthday`, `nationNo`, `sex`, `ArticleContent`, `BImgpath`)
                   VALUES ('{$userName}', '{$passWord}', '{$phone}', '{$email}', '{$birthday}', '{$nationNo}', '{$sex}', '{$ArticleContent}', '{$BImgpath}')";
    $result=$db->db_select_count($sql);
    if ($result){       //添加，并判断是否有重复
        echo "<script> alert('商品类别编号重复或商品类别名称重复，请重新输入！');window.history.back();</script>";
        return;
    }
    if(strlen($userName)>255){
        echo "<script> alert('！');window.history.back();</script>";
        return;
    }

    $sql="INSERT INTO `userinfo`(`userName`, `passWord`, `phone`, `email`, `birthday`, `nationNo`, `sex`, `ArticleContent`, `BImgpath`)
                   VALUES ('{$userName}', '{$passWord}', '{$phone}', '{$email}', '{$birthday}', '{$nationNo}', '{$sex}', '{$ArticleContent}', '{$BImgpath}')";
    $result=$db->db_select_count($sql);
    $result=$db->db_insert_delete_update($sql);
    if ($result){
        echo "<script>alert('添加成功');  window.location.href='userList.php';</script>";
    }else{
        echo "<script>alert('添加失败');  window.history.back();</script>";
    }
}else if ($action=="update"){       //修改
    $id=$_GET["id"];        //地址栏传来，用get
    $userName=$_POST["userName"];
    $passWord=$_POST["passWord"];
    $phone=$_POST["phone"];
    $email=$_POST["email"];
    $birthday=$_POST["birthday"];
    $nationNo=$_POST["nationNo"];
    $sex=$_POST["sex"];
    $ArticleContent=$_POST["ArticleContent"];
    $BImgpath=$_POST["BImgpath"];


//修改的类别编号、名称的长度超限，提示
    if(strlen($userName)>255){
        echo "<script> alert('名称不超过255个长度，请重新输入！');window.history.back();</script>";
        return;
    }

    $sql="UPDATE `sports`.`userinfo` SET `userName` = '{$userName}', `passWord` = '{$passWord}', `phone` = '{$phone}', `email` = '{$email}', `birthday` = '{$birthday}', `nationNo` = '{$nationNo}', `sex` = '{$sex}', `ArticleContent` = '{$ArticleContent}', `BImgpath` = '{$BImgpath}' WHERE `id` = {$id}";
    $result=$db->db_insert_delete_update($sql);
    if ($result){
        echo "<script>alert('修改成功');  window.location.href='userList.php';</script>";
    }else{
        echo "<script>alert('修改失败');  window.history.back();</script>";
    }
}else if($action=="delete"){//删除
    $id=$_GET["id"];
    $sql="DELETE FROM `userinfo` WHERE `id` = $id";
    $result=$db->db_insert_delete_update($sql);
    if ($result){
        echo "<script language='JavaScript'>alert('删除成功');window.location.href='userList.php';</script>";
    }else{
        echo "<script language='JavaScript'>alert('删除失败');window.history.back();</script>";
    }
}else if ($action=="DelAll"){//批量删除
    if (isset($_POST['DelBox'])&&!empty($_POST['DelBox'])){  //如果 有多选 并且 不空
        $id=implode(",",$_POST['DelBox']);  //把所有勾选的行的id   用逗号拼成 2,3,4,5,6
        $sql="Delete from userinfo where id in (".$id.")"; //Delete from user where id in (2,3,4,5,6)   完成批量删除
        $result=$db->db_insert_delete_update($sql);
        if ($result){
            echo "<script language='JavaScript'>alert('批量删除成功');window.location.href='userList.php';</script>";
        }else{
            echo "<script language='JavaScript'>alert('批量删除失败');window.history.back();</script>";
        }
    }else{
        echo "<script language='JavaScript'>alert('请勾选待删除的行!'); window.history.back();</script>";
    }
}