<?php
include "inc/Dbclass.php";

$action=$_GET["action"]; //动作是从地址栏（网址）传来，必须用GET接收

if ($action=="insert"){
    $jueseName=$_POST["jueseName"];
    $jueseId=$_POST["jueseId"];
    $sql="select * from qx_juese where (jueseName='{$jueseName}' or jueseId='{$jueseId}')";
    $result=$db->db_select_count($sql);
    if ($result){       //添加，并判断是否有重复
        echo "<script> alert('角色编号重复或角色名称重复，请重新输入！');window.history.back();</script>";
        return;
    }
    if(strlen($jueseId)>50 || strlen($jueseName)>255){
        echo "<script> alert('角色编号不超过50个，角色名称不超过255个长度，请重新输入！');window.history.back();</script>";
        return;
    }

    $sql="INSERT INTO `qx_juese`(`jueseName`, `jueseId`)  VALUES ('{$jueseName}', '{$jueseId}')";
    $result=$db->db_insert_delete_update($sql);
    if ($result){
        echo "<script>alert('添加成功');  window.location.href='jueseList.php';</script>";
    }else{
        echo "<script>alert('添加失败');  window.history.back();</script>";
    }
}else if ($action=="update"){       //修改
    $id=$_GET["id"];        //地址栏传来，用get
    $jueseName=$_POST["jueseName"]; //表单里传来，用post
    $jueseId=$_POST["jueseId"];

    $sql="select * from qx_juese where (jueseName='{$jueseName}' or jueseId='{$jueseId}') and id<>'{$id}'";
    //查询        角色表    条件是 （角色名=传来的角色名              或   角色编号=传来的角色编号     ） 并且 是其他记录
    //修改的名称、编号，不能和其他记录重复
    echo $sql;
    $result=$db->db_select_array($sql);
    if ($result){
        echo "<script> alert('修改的编号或名称与其他记录重复，请重新修改！');window.history.back();</script>";
        return;
    }
//修改的角色编号、名称的长度超限，提示
    if(strlen($jueseId)>50 || strlen($jueseName)>255){
        echo "<script> alert('角色编号不超过50个，角色名称不超过255个长度，请重新输入！');window.history.back();</script>";
        return;
    }

    $sql="UPDATE `qx_juese` SET `jueseName` = '{$jueseName}', `jueseId` = '{$jueseId}' WHERE `id` = {$id}";
    $result=$db->db_insert_delete_update($sql);
    if ($result){
        echo "<script>alert('修改成功');  window.location.href='jueseList.php';</script>";
    }else{
        echo "<script>alert('修改失败');  window.history.back();</script>";
    }
}else if($action=="delete"){//删除
    $id=$_GET["id"];
    $sql="DELETE FROM `qx_juese` WHERE `id` = $id";
    $result=$db->db_insert_delete_update($sql);
    if ($result){
        echo "<script language='JavaScript'>alert('删除成功');window.location.href='jueseList.php';</script>";
    }else{
        echo "<script language='JavaScript'>alert('删除失败');window.history.back();</script>";
    }
}else if ($action=="DelAll"){//批量删除
    if (isset($_POST['DelBox'])&&!empty($_POST['DelBox'])){  //如果 有多选 并且 不空
        $id=implode(",",$_POST['DelBox']);  //把所有勾选的行的id   用逗号拼成 2,3,4,5,6
        $sql="Delete from qx_juese where id in (".$id.")"; //Delete from juese where id in (2,3,4,5,6)   完成批量删除
        $result=$db->db_insert_delete_update($sql);
        if ($result){
            echo "<script language='JavaScript'>alert('批量删除成功');window.location.href='jueseList.php';</script>";
        }else{
            echo "<script language='JavaScript'>alert('批量删除失败');window.history.back();</script>";
        }
    }else{
        echo "<script language='JavaScript'>alert('请勾选待删除的行!'); window.history.back();</script>";
    }
}else if ($action=="active"){//批量删除
    $id=$_POST["id"];
    $isActive=$_POST["isActive"];
    $sql="UPDATE `qx_juese` SET `active` = {$isActive} WHERE `id` = {$id}"; //Delete from juese where id in (2,3,4,5,6)   完成批量删除
    $result=$db->db_insert_delete_update($sql);
    if ($result){
        $data=[ "code"=>1 ,"url"=>"jueselist.php" ];
    }else{
        $data=[ "code"=>0 ,"url"=>"jueselist.php" ];
    }
    echo json_encode($data);  //en表示编码  其他任何输出都屏蔽
}