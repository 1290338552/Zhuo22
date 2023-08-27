
<?php
include "inc/Dbclass.php";

$action=$_GET["action"]; //动作是从地址栏（网址）传来，必须用GET接收

if ($action=="insert"){
    $scrapName=$_POST["scrapName"];
    $scrapNo=$_POST["scrapNo"];
    $scraptime=$_POST["scraptime"];
    $scrapcause=$_POST["scrapcause"];
    $remark=$_POST["remark"];
    $sql="select * from scrap where (scrapName='{$scrapName}' or scrapNo='{$scrapNo}')";
    $result=$db->db_select_count($sql);
    if ($result){       //添加，并判断是否有重复
        echo "<script> alert('商品类别编号重复或商品类别名称重复，请重新输入！');window.history.back();</script>";
        return;
    }
    if(strlen($scrapNo)>50 || strlen($scrapName)>255){
        echo "<script> alert('商品类别编号不超过50个，类别名称不超过255个长度，请重新输入！');window.history.back();</script>";
        return;
    }

    $sql="INSERT INTO `scrap`(`scrapName`, `scrapNo`, `scraptime`, `scrapcause`, `remark`)  VALUES ('{$scrapName}', '{$scrapNo}', '{$scraptime}', '{$scrapcause}', '{$remark}')";
    $result=$db->db_insert_delete_update($sql);
    if ($result){
        echo "<script>alert('添加成功');  window.location.href='scrapList.php';</script>";
    }else{
        echo "<script>alert('添加失败');  window.history.back();</script>";
    }
}else if ($action=="update"){       //修改
    $id=$_GET["id"];        //地址栏传来，用get
    $scrapName=$_POST["scrapName"];
    $scrapNo=$_POST["scrapNo"];
    $scraptime=$_POST["scraptime"];
    $scrapcause=$_POST["scrapcause"];
    $remark=$_POST["remark"];

    $sql="select * from scrap where (scrapName='{$scrapName}' or scrapNo='{$scrapNo}') and id<>'{$id}'";
    //查询        类别表    条件是 （类别名=传来的类别名              或   类别编号=传来的类别编号     ） 并且 是其他记录
    //修改的名称、编号，不能和其他记录重复
    echo $sql;
    $result=$db->db_select_array($sql);
    if ($result){
        echo "<script> alert('修改的编号或名称与其他记录重复，请重新修改！');window.history.back();</script>";
        return;
    }
//修改的类别编号、名称的长度超限，提示
    if(strlen($scrapNo)>50 || strlen($scrapName)>255){
        echo "<script> alert('商品类别编号不超过50个，类别名称不超过255个长度，请重新输入！');window.history.back();</script>";
        return;
    }

    $sql="UPDATE `scrap` SET `scrapName` = '{$scrapName}', `scrapNo` = '{$scrapNo}', `scraptime` = '{$scraptime}', `scrapcause` = '{$scrapcause}', `remark` = '{$remark}' WHERE `id` = {$id}";
    $result=$db->db_insert_delete_update($sql);
    if ($result){
        echo "<script>alert('修改成功');  window.location.href='scrapList.php';</script>";
    }else{
        echo "<script>alert('修改失败');  window.history.back();</script>";
    }
}else if($action=="delete"){//删除
    $id=$_GET["id"];
    $sql="DELETE FROM `scrap` WHERE `id` = $id";
    $result=$db->db_insert_delete_update($sql);
    if ($result){
        echo "<script language='JavaScript'>alert('删除成功');window.location.href='scrapList.php';</script>";
    }else{
        echo "<script language='JavaScript'>alert('删除失败');window.history.back();</script>";
    }
}else if ($action=="DelAll"){//批量删除
    if (isset($_POST['DelBox'])&&!empty($_POST['DelBox'])){  //如果 有多选 并且 不空
        $id=implode(",",$_POST['DelBox']);  //把所有勾选的行的id   用逗号拼成 2,3,4,5,6
        $sql="Delete from scrap where id in (".$id.")"; //Delete from Category where id in (2,3,4,5,6)   完成批量删除
        $result=$db->db_insert_delete_update($sql);
        if ($result){
            echo "<script language='JavaScript'>alert('批量删除成功');window.location.href='scrapList.php';</script>";
        }else{
            echo "<script language='JavaScript'>alert('批量删除失败');window.history.back();</script>";
        }
    }else{
        echo "<script language='JavaScript'>alert('请勾选待删除的行!'); window.history.back();</script>";
    }
}