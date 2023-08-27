<?php
include "inc/Dbclass.php";
if (!$_SESSION["userName"] || $_SESSION["userName"] == "") { //如果（没有session变量 或 session变量=空）
    echo "<script> alert('请先登录！'); window.location.href='login.html'; </script>"; //提示，并跳转到登录页
}

$action=$_GET["action"];
if ($action=="insert"){ //完成添加
    $fileInfo=$_FILES['upFilePath'];
    print_r($fileInfo);
    var_dump(pathinfo($_FILES['upFilePath']['name']));
    $resourceNo=$_POST['resourceNo'];
    $resourceName=$_POST['resourceName'];
    $categoryNo=$_POST['categoryNo'];
    $introduction=$_POST['introduction'];
    $upFilePath=""; //接收图片路径+文件名
    $remark=$_POST['remark'];
    if(is_uploaded_file($_FILES['upFilePath']['tmp_name'])){
        $pos="uploadfile/"; //上传路径
        $destFolder=$pos.$_SESSION["userName"]."/"; //上传文件路径，每个用户享有单独的文件夹
        if(!is_dir($destFolder)){               //如果还没有路径，创建文件夹
            mkdir($destFolder);
            chown($destFolder,0777);        //并设置读写权限
        }
        $upFilePath=$destFolder.time().".".pathinfo($_FILES['upFilePath']['name'])['extension'];
        move_uploaded_file($_FILES['upFilePath']['tmp_name'],$upFilePath);
        $sql="INSERT INTO `resource`(`resourceNo`, `resourceName`, `categoryNo`, `introduction`, `upFilePath`, `remark`) 
VALUES ('{$resourceNo}', '{$resourceName}', '{$categoryNo}', '{$introduction}', '{$upFilePath}', '{$remark}')";
        echo "<br>".$sql."<br>";
          $result=$db->db_insert_delete_update($sql);
    if ($result){
        echo "<script>alert('添加成功');  window.location.href='upResourceList.php';</script>";
    }else{
        echo "<script>alert('添加失败');  window.history.back();</script>";
    }
    }
    var_dump(pathinfo($_FILES['upFilePath']['name'])['extension']);

}else if ($action=="update"){       //修改
    $id=$_GET["id"]; //地址栏传来的。用GET接收
    $resourceNo=$_POST['resourceNo'];
    $resourceName=$_POST['resourceName'];
    $categoryNo=$_POST['categoryNo'];
    $introduction=$_POST['introduction'];
    $upFilePath=""; //接收图片路径+文件名
    $remark=$_POST['remark'];
    if(is_uploaded_file($_FILES['upFilePath']['tmp_name'])) {
        $pos = "uploadfile/"; //上传路径
        $destFolder = $pos . $_SESSION["userName"] . "/"; //上传文件路径，每个用户享有单独的文件夹
        if (!is_dir($destFolder)) {               //如果还没有路径，创建文件夹
            mkdir($destFolder);
            chown($destFolder, 0777);        //并设置读写权限
        }
        $upFilePath = $destFolder . time() . "." . pathinfo($_FILES['upFilePath']['name'])['extension'];
        move_uploaded_file($_FILES['upFilePath']['tmp_name'], $upFilePath);
    }
    $sql="select * from resource where (resourceNo='{$resourceNo}') and id<>'{$id}'"; //不是本id（不是本记录）的其他记录，如果编号等于要改的编号。重复
// echo $sql;
    $result=$db->db_select_oneRow($sql);
    if ($result){
        echo "<script> alert('修改的资源编号重复，请重新修改！'); window.history.back();</script>";
        return;
    }
    $sql="UPDATE `resource` SET `resourceNo` = '{$resourceNo}', `resourceName` = '{$resourceName}', `categoryNo` = '{$categoryNo}', `introduction` = '{$introduction}', `upFilePath` = '{$upFilePath}', `remark` = '{$remark}' WHERE `id` = {$id}";
echo $sql;
    $result=$db->db_insert_delete_update($sql);
    if ($result){
        echo "<script>alert('修改成功');  window.location.href='upResourceList.php';</script>";
    }else{
        echo "<script>alert('修改失败');  window.history.back();</script>";
    }
}else if($action=="delete"){//删除
    $id=$_GET["id"]; //前一页resourceList.php的删除按钮，以地址栏传来id  所以这里用GET接收

    $sql2="select * from resource WHERE `id` = $id";
    $result2=$db->db_select_oneRow($sql2);
    $yaoShanDeTu=$result2["resourcePicture"]; //读取该记录。把图片路径临时存起来

    $sql="DELETE FROM `resource` WHERE `id` = $id";
    $result=$db->db_insert_delete_update($sql);
    if ($result){
        if(file_exists("uploadfile/{$yaoShanDeTu}"))
            unlink("uploadfile/{$yaoShanDeTu}");  //记录都成功删除了。就删图片   改进：先用if判断图片存在？如果存在，就删图片
        echo "<script language='JavaScript'>alert('删除成功'); window.location.href='upResourceList.php';</script>";
    }else{
        echo "<script language='JavaScript'>alert('删除失败');window.history.back();</script>";
    }
}else if ($action=="DelAll"){//批量删除

    if (isset($_POST['DelBox'])&&!empty($_POST['DelBox'])){
        $id=implode(",",$_POST['DelBox']);

        $sql2="select * from resource  where id in ({$id})"; //先把要删的多条记录读出来
        $result2=$db->db_select_array($sql2);         //等会用于删除图片

        $sql="Delete from resource where id in (".$id.")";
        $result=$db->db_insert_delete_update($sql);
        if ($result){

            foreach ($result2 as $key=>$item){                          //对每一个要删的记录
                if(file_exists("uploadfile/{$item['resourcePicture']}")){  //如果图片文件存在
                    unlink("uploadfile/{$item['resourcePicture']}");       //就把该记录的图片删除
                }
            }

            echo "<script language='JavaScript'>alert('批量删除成功');window.location.href='resourceList.php';</script>";
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