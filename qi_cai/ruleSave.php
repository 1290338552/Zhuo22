<?php
include "inc/Dbclass.php";

$action=$_GET["action"]; //动作是从地址栏（网址）传来，必须用GET接收

if ($action=="insert"){
    $ruleName=$_POST["ruleName"];
    $ruleId=$_POST["ruleId"];
    $menuLink=$_POST["menuLink"];
    $moduleName=$_POST["moduleName"];
    $iconClass=$_POST["iconClass"];
    $sql="select * from qx_rule where (ruleName='{$ruleName}' or ruleId='{$ruleId}')";
    $result=$db->db_select_count($sql);
    if ($result){       //添加，并判断是否有重复
        echo "<script> alert('模块编号重复或商品类别名称重复，请重新输入！');window.history.back();</script>";
        return;
    }
    if(strlen($ruleId)>50 || strlen($ruleName)>255){
        echo "<script> alert('模块编号不超过50个，模块名称不超过255个长度，请重新输入！');window.history.back();</script>";
        return;
    }

    $sql="INSERT INTO qx_rule(`ruleId`, `ruleName`,`menuLink`, `moduleName`,`iconClass`)  VALUES ('{$ruleId}', '{$ruleName}', '{$menuLink}', '{$moduleName}', '{$iconClass}')";
    $result=$db->db_insert_delete_update($sql);
    if ($result){
        echo "<script>alert('添加成功');  window.location.href='ruleList.php';</script>";
    }else{
        echo "<script>alert('添加失败');  window.history.back();</script>";
    }
}else if ($action=="update"){       //修改
    $id=$_GET["id"];        //地址栏传来，用get
    $ruleName=$_POST["ruleName"]; //表单里传来，用post
    $ruleId=$_POST["ruleId"];
    $menuLink=$_POST["menuLink"];
    $moduleName=$_POST["moduleName"];
    $iconClass=$_POST["iconClass"];

    $sql="select * from qx_rule where (ruleName='{$ruleName}' or ruleId='{$ruleId}') and id<>'{$id}'";
           //查询        类别表    条件是 （类别名=传来的类别名              或   类别编号=传来的类别编号     ） 并且 是其他记录
    //修改的名称、编号，不能和其他记录重复
    $result=$db->db_select_array($sql);
    if ($result){
        echo "<script> alert('修改的编号或名称与其他记录重复，请重新修改！');window.history.back();</script>";
        return;
    }
//修改的类别编号、名称的长度超限，提示
    if(strlen($ruleId)>50 || strlen($ruleName)>255){
        echo "<script> alert('模块编号不超过50个，模块名称不超过255个长度，请重新输入！');window.history.back();</script>";
        return;
    }

    $sql="UPDATE qx_rule SET `ruleName` = '{$ruleName}', `ruleId` = '{$ruleId}', `menuLink` = '{$menuLink}', `moduleName` = '{$moduleName}', `iconClass` = '{$iconClass}' WHERE `id` = {$id}";
    $result=$db->db_insert_delete_update($sql);
    if ($result){
        echo "<script>alert('修改成功');  window.location.href='ruleList.php';</script>";
    }else{
        echo "<script>alert('修改失败');  window.history.back();</script>";
    }
}else if($action=="delete"){//删除
    $id=$_GET["id"];
    $sql="DELETE FROM qx_rule WHERE `id` = $id";
    $result=$db->db_insert_delete_update($sql);
    if ($result){
        echo "<script language='JavaScript'>alert('删除成功');window.location.href='ruleList.php';</script>";
    }else{
        echo "<script language='JavaScript'>alert('删除失败');window.history.back();</script>";
    }
}else if ($action=="DelAll"){//批量删除
    if (isset($_POST['DelBox'])&&!empty($_POST['DelBox'])){  //如果 有多选 并且 不空
        $id=implode(",",$_POST['DelBox']);  //把所有勾选的行的id   用逗号拼成 2,3,4,5,6
        $sql="Delete from qx_rule where id in (".$id.")"; //Delete from qx_rule where id in (2,3,4,5,6)   完成批量删除
        $result=$db->db_insert_delete_update($sql);
        if ($result){
            echo "<script language='JavaScript'>alert('批量删除成功');window.location.href='ruleList.php';</script>";
        }else{
            echo "<script language='JavaScript'>alert('批量删除失败');window.history.back();</script>";
        }
    }else{
        echo "<script language='JavaScript'>alert('请勾选待删除的行!'); window.history.back();</script>";
    }
}