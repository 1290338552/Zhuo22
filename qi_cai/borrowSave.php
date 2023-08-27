
<?php
include "inc/Dbclass.php";

$action=$_GET["action"]; //动作是从地址栏（网址）传来，必须用GET接收

if ($action=="insert"){
    $equipmentNo=$_POST["equipmentNo"];
    $quantity=$_POST["quantity"];
    $borrowtime=$_POST["borrowtime"];
    $nameNo=$_POST["nameNo"];

    $sql="INSERT INTO `borrow`(`equipmentNo`, `quantity`, `borrowtime`, `nameNo`)  VALUES ('{$equipmentNo}', '{$quantity}', '{$borrowtime}', '{$nameNo}')";
    $result=$db->db_insert_delete_update($sql);
    if ($result){
        echo "<script>alert('添加成功');  window.location.href='borrowList.php';</script>";
    }else{
        echo "<script>alert('添加失败');  window.history.back();</script>";
    }
}else if ($action=="update"){       //修改
    $id=$_GET["id"];        //地址栏传来，用get
    $equipmentNo=$_POST["equipmentNo"];
    $quantity=$_POST["quantity"];
    $borrowtime=$_POST["borrowtime"];
    $nameNo=$_POST["nameNo"];

    $sql="UPDATE `borrow` SET `equipmentNo` = '{$equipmentNo}', `quantity` = '{$quantity}', `borrowtime` = '{$borrowtime}', `nameNo` = '{$nameNo}' WHERE `id` = {$id}";
    $result=$db->db_insert_delete_update($sql);
    if ($result){
        echo "<script>alert('修改成功');  window.location.href='borrowList.php';</script>";
    }else{
        echo "<script>alert('修改失败');  window.history.back();</script>";
    }
}else if($action=="delete"){//删除
    $id=$_GET["id"];
    $sql="DELETE FROM `borrow` WHERE `id` = $id";
    $result=$db->db_insert_delete_update($sql);
    if ($result){
        echo "<script language='JavaScript'>alert('删除成功');window.location.href='borrowList.php';</script>";
    }else{
        echo "<script language='JavaScript'>alert('删除失败');window.history.back();</script>";
    }
}else if ($action=="DelAll"){//批量删除
    if (isset($_POST['DelBox'])&&!empty($_POST['DelBox'])){  //如果 有多选 并且 不空
        $id=implode(",",$_POST['DelBox']);  //把所有勾选的行的id   用逗号拼成 2,3,4,5,6
        $sql="Delete from borrow where id in (".$id.")"; //Delete from Category where id in (2,3,4,5,6)   完成批量删除
        $result=$db->db_insert_delete_update($sql);
        if ($result){
            echo "<script language='JavaScript'>alert('批量删除成功');window.location.href='borrowList.php';</script>";
        }else{
            echo "<script language='JavaScript'>alert('批量删除失败');window.history.back();</script>";
        }
    }else{
        echo "<script language='JavaScript'>alert('请勾选待删除的行!'); window.history.back();</script>";
    }
}