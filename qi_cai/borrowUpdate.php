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
$sql="select * from equipment";     //用于动态绑定类别下拉选项的
$equipment=$db->db_select_array($sql); //读二维数组（多行多列的类别)

$sql="select * from name";     //用于动态绑定类别下拉选项的
$name=$db->db_select_array($sql); //读二维数组（多行多列的类别)

$id=$_GET['id']; //id是地址栏传来的
$sqlS="select * from borrow where id=$id "; //读取被修改的记录
$result=$db->db_select_oneRow($sqlS);
?>
<form action="borrowSave.php?action=update&id=<?php  echo $result['id']; ?>" method="post" name="Form" enctype="multipart/form-data" >
    <div style="margin-left: auto;margin-right: auto;width: 400px; height: 650px; text-align: center;"> <!--页面居中-->
        <div style="width: 300px;text-align: left;"><span style="font-family:'Yu Gothic Light';font-size:40px;color: #748f62;text-align: left;width: 100px;">CATEGORY  IN </span></div>
        <div style="width: 400px; height: auto;background-color: white;">
            <div style="width: 400px;height: 40px; border-bottom: 1px solid #7c7b7d;padding-top: 10px;margin-bottom: 20px;">
                <div style="width: 110px;height:38px;color: #333333;margin-left: auto;margin-right: auto;text-align: center; border-bottom: 3px solid #434343;">借出修改</div>
            </div>
            <div style="width: 400px;text-align: left;margin-left: 50px;">

                <select name="equipmentNo" required style="padding-left: 30px; height: 40px;width: 260px;">
                    <option value="">--- 请选择器材 ---</option>
                    <?php
                    foreach ($equipment as $key=>$item){  //对$result的每一行  当成  下标=>内容   内容就是一行记录
                        ?>
                        <option value="<?php echo $item['equipmentNo'] ?>" <?php if($result['equipmentNo']==$item['equipmentNo']) echo 'selected'; ?> > <?php echo $item['equipmentName']?> </option>
                        <?php
                    }
                    ?>
                </select> <br/><br/>

                <input  type="text" name="quantity" value="<?php  echo $result['quantity']; ?>" id="passWord" placeholder="器材数量" required style="padding-left:30px;background:url(images/lock.jpg) no-repeat left  center;height: 40px;width: 260px; "><br/><br/>
                <input  type="data" name="borrowtime" value="<?php  echo $result['borrowtime']; ?>" id="borrowtime" placeholder="借用时间" required style="padding-left:30px;background:url(images/lock.jpg) no-repeat left  center;height: 40px;width: 260px; "><br/><br/>

                <select name="nameNo" required style="padding-left: 30px; height: 40px;width: 260px;">
                    <option value="">--- 请选择借用人 ---</option>
                    <?php
                    foreach ($name as $key=>$item){  //对$result的每一行  当成  下标=>内容   内容就是一行记录
                        ?>
                        <option value="<?php echo $item['nameNo'] ?>" <?php if($result['nameNo']==$item['nameNo']) echo 'selected'; ?> > <?php echo $item['nameName']?> </option>
                        <?php
                    }
                    ?>
                </select> <br/><br/>




            </div>
            <div style="width: 400px;text-align: right;">
                <input  type="submit" value="修&nbsp;&nbsp;改" style="height: 40px; width: 100px; border-radius: 5px;background-color: #759063;font-size: 16px;color: white;margin-right: 60px;" ><br/><br/>
            </div>
        </div>
    </div>
</form>
</body>
</html>
















