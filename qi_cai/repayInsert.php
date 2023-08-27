<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="CSS/CSS.css">

</head>
<body style="background-color: #f3f3f3">
<?php
include "inc/DbClass.php";
// $sql="select * from test";
// $category=$db->db_select_array($sql); //读二维数组（多行多列的类别)
//
//$sql="select * from province";
//$province=$db->db_select_array($sql); //读二维数组（多行多列的类别)

$sql="select * from equipment";
$equipment=$db->db_select_array($sql); //读二维数组（多行多列的类别)

$sql="select * from name";
$name=$db->db_select_array($sql); //读二维数组（多行多列的类别)

?>
<form action="repaySave.php?action=insert" method="post" name="Form" enctype="multipart/form-data" >
    <div style="margin-left: auto;margin-right: auto;width: 400px; height: 650px; text-align: center;"> <!--页面居中-->
        <div style="width: 300px;text-align: left;"><span style="font-family:'Yu Gothic Light';font-size:40px;color: #748f62;text-align: left;width: 100px;">scrap  IN </span></div>
        <div style="width: 400px; height: auto;background-color: white;">
            <div style="width: 400px;height: 40px; border-bottom: 1px solid #7c7b7d;padding-top: 10px;margin-bottom: 20px;">
                <div style="width: 110px;height:38px;color: #333333;margin-left: auto;margin-right: auto;text-align: center; border-bottom: 3px solid #434343;">借出添加</div>
            </div>
            <div style="width: 400px;text-align: left;margin-left: 50px;">
                <select name="equipmentNo" required style="padding-left: 30px; height: 40px;width: 260px;">
                    <option value="">--- 请选择器材名称 ---</option>
                    <?php
                    foreach ($equipment as $key=>$item){  //对$result的每一行  当成  下标=>内容   内容就是一行记录
                        echo  "<option value='{$item['equipmentName']}'> {$item['equipmentName']} </option>";
                    }
                    ?>
                </select> <br/><br/>

                <input  type="text" name="quantity" id="passWord" placeholder="器材数量" required style="padding-left:30px;background:url(images/lock.jpg) no-repeat left  center;height: 40px;width: 260px; "><br/><br/>
                <input  type="date" name="repaytime" id="passWord" placeholder="借用时间" required style="padding-left:30px;background:url(images/lock.jpg) no-repeat left  center;height: 40px;width: 260px; "><br/><br/>

                <select name="nameNo" required style="padding-left: 30px; height: 40px;width: 260px;">
                    <option value="">--- 请选择归还人 ---</option>
                    <?php
                    foreach ($name as $key=>$item){  //对$result的每一行  当成  下标=>内容   内容就是一行记录
                        echo  "<option value='{$item['nameName']}'> {$item['nameName']} </option>";
                    }
                    ?>
                </select> <br/><br/>



            </div>
            <div style="width: 400px;text-align: right;">
                <input  type="submit" value="添&nbsp;&nbsp;加" style="height: 40px; width: 100px; border-radius: 5px;background-color: #759063;font-size: 16px;color: white;margin-right: 60px;" ><br/><br/>
            </div>
        </div>
    </div>
</form>
</body>
</html>















