<?php
include "inc/Dbclass.php";

$action=$_GET["action"]; //动作是从地址栏（网址）传来，必须用GET接收

if ($action=="insert"){
    $jueseId=$_POST["jueseId"];
    $ruleId=$_POST["ruleId"];
    $sql="select distinct ruleId from qx_jueserule  where jueseId='$jueseId'  ";
    $qx_jueserule=$db->db_select_array($sql);
    $sqlInsert="";

    foreach ($ruleId as $value){
        if(!in_array($value,array_column($qx_jueserule,'ruleId'))){
            $sqlInsert="INSERT INTO `qx_jueserule`(`jueseId`, `ruleId`) VALUES ('{$jueseId}', '{$value}')";
            $result=$db->db_insert_delete_update($sqlInsert);
        }
    }
    foreach ($qx_jueserule as $value){
        if(!in_array($value['ruleId'],$ruleId)){
            $sqlInsert="delete from `qx_jueserule` where (jueseId='{$jueseId}' and ruleId='{$value['ruleId']}')";
            $result=$db->db_insert_delete_update($sqlInsert);
        }
    }
//    var_dump($sqlInsert);
//    $result=$db->db_insert_delete_update($sqlInsert);
    if ($result){
        echo "<script>alert('设置成功');  window.location.href='jueseruleList.php';</script>";
    }else{
        echo "<script>alert('设置失败');  window.history.back();</script>";
    }
}else if ($action=="update"){       //修改
    $jueseId=$_POST["jueseId"];
    $ruleId=$_POST["ruleId"];
    $sql="select distinct ruleId from qx_jueserule  where jueseId='$jueseId'  ";
    $qx_jueserule=$db->db_select_array($sql);
    $sqlInsert="";
    foreach ($ruleId as $value){
        if(!in_array($value,array_column($qx_jueserule,'ruleId')))
            $sqlInsert.="INSERT INTO `qx_jueserule`(`jueseId`, `ruleId`) VALUES ('{$jueseId}', '{$value}');";
    }
    foreach ($qx_jueserule as $value){
        if(!in_array($value['ruleId'],$ruleId))
            $sqlInsert.="delete from `qx_jueserule` where (jueseId='{$jueseId}' and ruleId='{$value['ruleId']}');";
    }
//    var_dump($sqlInsert);
    $result=$db->db_insert_delete_update($sqlInsert);
    if ($result){
        echo "<script>alert('设置成功');  window.location.href='jueseruleList.php';</script>";
    }else{
        echo "<script>alert('设置失败');  window.history.back();</script>";
    }
}else if($action=="delete"){//删除
    $jueseId=$_GET["jueseId"];
    $ruleId=$_GET["ruleId"];
    $sql="DELETE FROM `qx_jueserule` WHERE `jueseId` = '$jueseId' and `ruleId` = '$ruleId'";
    $result=$db->db_insert_delete_update($sql);
    if ($result){
        echo "<script language='JavaScript'>alert('删除成功');window.location.href='jueseruleList.php';</script>";
    }else{
        echo "<script language='JavaScript'>alert('删除失败');window.history.back();</script>";
    }
}else if ($action=="DelAll"){//批量删除
    if (isset($_POST['DelBox'])&&!empty($_POST['DelBox'])){  //如果 有多选 并且 不空
        $id=implode(",",$_POST['DelBox']);  //把所有勾选的行的id   用逗号拼成 2,3,4,5,6
        $sql="Delete from qx_jueserule where id in (".$id.")"; //Delete from Category where id in (2,3,4,5,6)   完成批量删除
        $result=$db->db_insert_delete_update($sql);
        if ($result){
            echo "<script language='JavaScript'>alert('批量删除成功');window.location.href='jueseruleList.php';</script>";
        }else{
            echo "<script language='JavaScript'>alert('批量删除失败');window.history.back();</script>";
        }
    }else{
        echo "<script language='JavaScript'>alert('请勾选待删除的行!'); window.history.back();</script>";
    }
}else if($action=="JueseToRule"){
    $jueseId=$_POST["jueseId"];
    $sql="select distinct ruleId from qx_jueserule  where jueseId='$jueseId'  ";
    $qx_jueserule=$db->db_select_array($sql);
    $sql="select * from qx_rule";
    $qx_rule=$db->db_select_array($sql);
    //形成带勾选的角色多选框（把选择的这个用户 已有的权限勾选）
    $option="";
    foreach ($qx_rule as $key=>$item){
        if(in_array($item['ruleId'],array_column($qx_jueserule,'ruleId'))){
            $option.="<input type='checkbox' name='ruleId[]' value='{$item['ruleId']}' checked > {$item['ruleName']} <br/>" ; //如果该用户原先已有该角色，勾选
        }else{
            $option.="<input type='checkbox' name='ruleId[]' value='{$item['ruleId']}'         > {$item['ruleName']} <br/>" ; //否则，不勾选
        }
    }
    echo  json_encode($option);  //进行JSON编码，并输出（输出相当于返回数据）
}