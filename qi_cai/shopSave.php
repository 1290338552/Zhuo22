<?php
include "inc/DbClass.php";

$action=$_GET["action"];

if ($action=="insert"){ //完成添加
    $shopNo=$_POST['shopNo'];
    $shopName=$_POST['shopName'];
    $shopDescp=$_POST['shopDescp'];
    $categoryNo=$_POST['categoryNo'];
    $BImgpath=$_POST["BImgpath"]; //接收图片路径+文件名
    $shopMoney=$_POST['shopMoney'];
    $remark=$_POST['remark'];

    $sql="select * from shop where (shopNo='{$shopNo}')";
    $result=$db->db_select_oneRow($sql);
    if ($result){       //添加，并判断是否有重复
        echo "<script> alert('商品编号重复，请重新输入！'); window.history.back();</script>";
        return;
    }
    $sql="INSERT INTO `shop`(`shopNo`, `shopName`, `categoryNo`, `shopMoney`, `BImgpath`, `shopDescp`, `remark`) 
                       VALUES ('{$shopNo}', '{$shopName}', '{$categoryNo}', '{$shopMoney}', '{$BImgpath}', '{$shopDescp}', '{$remark}')";
echo $sql;
    $result=$db->db_insert_delete_update($sql);
    if ($result){
        echo "<script>alert('添加成功');  window.location.href='shopList.php';</script>";
    }else{
        echo "<script>alert('添加失败');  window.history.back();</script>";
    }
}else if ($action=="update"){       //修改
    $id=$_GET["id"]; //地址栏传来的。用GET接收
    $shopNo=$_POST['shopNo'];
    $shopName=$_POST['shopName'];
    $shopDescp=$_POST['shopDescp'];
    $categoryNo=$_POST['categoryNo'];
    $BImgpath=$_POST["BImgpath"]; //接收图片路径+文件名
    $shopMoney=$_POST['shopMoney'];
    $remark=$_POST['remark'];

    $sql="select * from shop where (shopNo='{$shopNo}') and id<>'{$id}'"; //不是本id（不是本记录）的其他记录，如果编号等于要改的编号。重复
// echo $sql;
    $result=$db->db_select_oneRow($sql);
    if ($result){
        echo "<script> alert('修改的商品编号重复，请重新修改！'); window.history.back();</script>";
        return;
    }
    $sql="UPDATE shop SET `shopNo` = '{$shopNo}', `shopName` = '{$shopName}', `categoryNo` = '{$categoryNo}', `shopMoney` = '{$shopMoney}', 
                                `BImgpath` = '{$BImgpath}', `shopDescp` = '{$shopDescp}', `remark` = '{$remark}' WHERE `id` = {$id}";
echo $sql;
    $result=$db->db_insert_delete_update($sql);
    if ($result){
        echo "<script>alert('修改成功');  window.location.href='shopList.php';</script>";
    }else{
        echo "<script>alert('修改失败');  window.history.back();</script>";
    }
}else if($action=="delete"){//删除
    $id=$_GET["id"]; //前一页shopList.php的删除按钮，以地址栏传来id  所以这里用GET接收

    $sql2="select * from shop WHERE `id` = $id";
    $result2=$db->db_select_oneRow($sql2);
    $yaoShanDeTu=$result2["shopPicture"]; //读取该记录。把图片路径临时存起来

    $sql="DELETE FROM `shop` WHERE `id` = $id";
    $result=$db->db_insert_delete_update($sql);
    if ($result){
        if(file_exists("uploadfile/{$yaoShanDeTu}"))
            unlink("uploadfile/{$yaoShanDeTu}");  //记录都成功删除了。就删图片   改进：先用if判断图片存在？如果存在，就删图片
        echo "<script language='JavaScript'>alert('删除成功'); window.location.href='shopList.php';</script>";
    }else{
        echo "<script language='JavaScript'>alert('删除失败');window.history.back();</script>";
    }
}else if ($action=="DelAll"){//批量删除

    if (isset($_POST['DelBox'])&&!empty($_POST['DelBox'])){
        $id=implode(",",$_POST['DelBox']);

        $sql2="select * from shop  where id in ({$id})"; //先把要删的多条记录读出来
        $result2=$db->db_select_array($sql2);         //等会用于删除图片

        $sql="Delete from shop where id in (".$id.")";
        $result=$db->db_insert_delete_update($sql);
        if ($result){

            foreach ($result2 as $key=>$item){                          //对每一个要删的记录
                if(file_exists("uploadfile/{$item['BImgpath']}")){  //如果图片文件存在
                    unlink("uploadfile/{$item['BImgpath']}");       //就把该记录的图片删除
                }
            }

            echo "<script language='JavaScript'>alert('批量删除成功');window.location.href='shopList.php';</script>";
        }else{
            echo "<script language='JavaScript'>alert('批量删除失败');window.history.back();</script>";
        }
    }else{
        echo "<script language='JavaScript'>alert('请勾选待删除的行!'); window.history.back();</script>";
    }
}else if($action=="provinceToCity"){  //如果（动作 == 从省选择城市）
    $province_no=$_POST["province_no"]; //先接收省编号
    $sql="select * from shi  where province_no='{$province_no}'";
    $result=$db->db_select_array($sql);  //读出该省的所有城市
    //形成下拉选项
    $option="<option value=''>请选城市</option>";
    foreach ($result as $key=>$value){
        $option .="<option value='{$value['city_no']}'> {$value['city_name']} </option>" ; // . 表示连接的意思。如同Java的+
    }
    echo  json_encode($option);  //进行JSON编码，并输出（输出相当于返回数据）
}else if($action=="cityToCounty"){  //如果（动作 == 从城市选择县）
    $city_no=$_POST["city_no"]; //先接收省编号
    $sql="select * from county  where city_no='{$city_no}'";
    $result=$db->db_select_array($sql);  //读出该省的所有城市
    //形成下拉选项
    $option="<option value=''>请选县</option>";
    foreach ($result as $key=>$value){
        $option .="<option value='{$value['county_no']}'> {$value['county_name']} </option>" ; // . 表示连接的意思。如同Java的+
    }
    echo  json_encode($option);  //进行JSON编码，并输出（输出相当于返回数据）
}