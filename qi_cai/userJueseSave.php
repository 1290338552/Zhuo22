<?php
include "inc/Dbclass.php";

$action=$_GET["action"]; //动作是从地址栏（网址）传来，必须用GET接收

if ($action=="insert"){
    $userName=$_POST["userName"];
    $jueseId=$_POST["jueseId"];
    $sql="select distinct jueseId from qx_userjuese  where userName='$userName'  ";
    $qx_userjuese=$db->db_select_array($sql);
    $sqlInsert="";
    foreach ($jueseId as $value){
        if(!in_array($value,array_column($qx_userjuese,'jueseId')))
            $sqlInsert.="INSERT INTO `qx_userjuese`(`userName`, `jueseId`) VALUES ('{$userName}', '{$value}');";
    }
    foreach ($qx_userjuese as $value){
        if(!in_array($value['jueseId'],$jueseId))
            $sqlInsert.="delete from `qx_userjuese` where (userName='{$userName}' and jueseId='{$value['jueseId']}');";
    }
//    var_dump($sqlInsert);
    $result=$db->db_insert_delete_update($sqlInsert);
    if ($result){
        echo "<script>alert('设置成功');  window.location.href='userJueseList.php';</script>";
    }else{
        echo "<script>alert('设置失败');  window.history.back();</script>";
    }
}else if ($action=="update"){       //修改
    $userName=$_POST["userName"];
    $jueseId=$_POST["jueseId"];
    $sql="select distinct jueseId from qx_userjuese  where userName='$userName'  ";
    $qx_userjuese=$db->db_select_array($sql);
    $sqlInsert="";
    foreach ($jueseId as $value){
        if(!in_array($value,array_column($qx_userjuese,'jueseId')))
            $sqlInsert.="INSERT INTO `qx_userjuese`(`userName`, `jueseId`) VALUES ('{$userName}', '{$value}');";
    }
    foreach ($qx_userjuese as $value){
        if(!in_array($value['jueseId'],$jueseId))
            $sqlInsert.="delete from `qx_userjuese` where (userName='{$userName}' and jueseId='{$value['jueseId']}');";
    }
//    var_dump($sqlInsert);
    $result=$db->db_insert_delete_update($sqlInsert);
    if ($result){
        echo "<script>alert('设置成功');  window.location.href='userJueseList.php';</script>";
    }else{
        echo "<script>alert('设置失败');  window.history.back();</script>";
    }
}else if($action=="delete"){//删除
    $id=$_GET["id"];
    $sql="DELETE FROM `Category` WHERE `id` = $id";
    $result=$db->db_insert_delete_update($sql);
    if ($result){
        echo "<script language='JavaScript'>alert('删除成功');window.location.href='CategoryList.php';</script>";
    }else{
        echo "<script language='JavaScript'>alert('删除失败');window.history.back();</script>";
    }
}else if ($action=="DelAll"){//批量删除
    if (isset($_POST['DelBox'])&&!empty($_POST['DelBox'])){  //如果 有多选 并且 不空
        $id=implode(",",$_POST['DelBox']);  //把所有勾选的行的id   用逗号拼成 2,3,4,5,6
        $sql="Delete from Category where id in (".$id.")"; //Delete from Category where id in (2,3,4,5,6)   完成批量删除
        $result=$db->db_insert_delete_update($sql);
        if ($result){
            echo "<script language='JavaScript'>alert('批量删除成功');window.location.href='CategoryList.php';</script>";
        }else{
            echo "<script language='JavaScript'>alert('批量删除失败');window.history.back();</script>";
        }
    }else{
        echo "<script language='JavaScript'>alert('请勾选待删除的行!'); window.history.back();</script>";
    }
}else if($action=="userNameToJuese"){
    $userName=$_POST["userName"];
    $sql="select distinct jueseId from qx_userjuese  where userName='$userName'  ";
    $qx_userjuese=$db->db_select_array($sql);
    $sql="select * from qx_juese";
    $qx_juese=$db->db_select_array($sql);
    //形成带勾选的角色多选框（把选择的这个用户 已有的权限勾选）
    $option="";
    foreach ($qx_juese as $key=>$item){
        if(in_array($item['jueseId'],array_column($qx_userjuese,'jueseId'))){
            $option.="<input type='checkbox' name='jueseId[]' value='{$item['jueseId']}' checked > {$item['jueseName']} <br/>" ; //如果该用户原先已有该角色，勾选
        }else{
            $option.="<input type='checkbox' name='jueseId[]' value='{$item['jueseId']}'         > {$item['jueseName']} <br/>" ; //否则，不勾选
        }
    }
    echo  json_encode($option);  //进行JSON编码，并输出（输出相当于返回数据）
}