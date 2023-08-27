<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="CSS/CSS.css">
    <!-- zui css -->
    <link rel="stylesheet" href="dist/css/zui.min.css">
    <link rel="stylesheet" href="dist/theme/blue.css">
    <!-- app css -->
    <link rel="stylesheet" href="css/app.css">
    <!-- jquery js -->
    <script src="dist/lib/jquery/jquery.js"></script>
    <?php
    include "inc/power.php";
    //$menuModule=$quanXian->getMenuModule();
    //$hasPower=false;
    //foreach ($menuModule as $item){
    //    if(in_array($quanXian->php_self(),explode('|',$item["moduleName"])) )
    //        $hasPower=true;
    //}
    //if(!$hasPower){
    //    echo "<script> alert('您没有权限访问此模块，请联系管理员！'); window.location.href='index.php'; </script>";
    //    return;
    //}
//    include "inc/Dbclass.php"; //凡是用到数据库操作，都要此包含
    $id=$_GET["id"]; //先接收id，知道改谁
    $sql="select  *  from  qx_rule  where  id={$id} ";//做条查询语句，把此id记录读出来
    $result=$db->db_select_oneRow($sql); //调用读一行
    //切记，下面的字段名都要改为自己表中对应的字段名
    ?>
</head>
<body style="background-color: #f3f3f3">
<p style="background-color: #f3f3f3">
<form action="ruleSave.php?action=update&id=<?php  echo $result['id']; ?>" method="post" name="Form" enctype="multipart/form-data" >
    <div style="margin-left: auto;margin-right: auto;width: 400px; height: 650px; text-align: center;"> <!--页面居中-->
      <div style="width: 300px;text-align: left;"><span style="font-family:'Yu Gothic Light';font-size:40px;color: #748f62;text-align: left;width: 100px;">Module   Update </span></div>
      <div style="width: 500px; height: auto;background-color: white;">
          <div style="width: 400px;height: 40px; border-bottom: 1px solid #7c7b7d;padding-top: 10px;margin-bottom: 20px;">
              <div style="width: 110px;height:38px;color: #333333;margin-left: auto;margin-right: auto;text-align: center; border-bottom: 3px solid #434343;">模块修改</div>
          </div>
          <div style="width: 400px;text-align: left;margin-left: 50px;">
              <input  type="text" name="ruleId" value="<?php  echo $result['ruleId']; ?>" placeholder="类别编号" required style="padding-left: 30px; background:url(images/person.jpg) no-repeat left  center;height: 40px;width: 300px;"><br/><br/>
              <input  type="text" name="ruleName" value="<?php  echo $result['ruleName']; ?>" id="passWord" placeholder="类别名称" required style="padding-left:30px;background:url(images/lock.jpg) no-repeat left  center;height: 40px;width: 300px; "><br/><br/>
              <input  type="text" name="menuLink" value="<?php  echo $result['menuLink']; ?>" placeholder="规则(模块)链接的网页文件名" required style="padding-left: 30px; background:url(images/person.jpg) no-repeat left  center;height: 40px;width: 300px;"><br/><br/>
              <input  type="text" name="moduleName" value="<?php  echo $result['moduleName']; ?>" placeholder="规则(模块)包含的所有网页名，“|”分隔" required style="padding-left:30px;background:url(images/movie.jpg) no-repeat left  center;height: 40px;width: 300px; "><br/><br/>
              <p>以竖线分隔网页名，例如：movielist.php|movieinsert.php|movieupdate.php</p>
              <input  type="text" name="iconClass" value="<?php  echo $result['iconClass']; ?>" placeholder="规则(模块)名字前面的图标样式" required style="padding-left:30px;background:url(images/country.JPG) no-repeat left  center;height: 40px;width: 300px; "><br/><br/>

          </div>
          <div style="width: 500px;text-align: center;">
               <input  type="submit" value="修&nbsp;&nbsp;改" style="height: 40px; width: 100px; border-radius: 5px;background-color: #759063;font-size: 16px;color: white;margin-right: 60px;" ><br/><br/>
          </div>
      </div>
    </div>
</form>
<p align="center" style="font-size: 19px;color: red;">已有的模块编号、模块名称如下，请勿重复：</p>
<div class="panel-body">
    <table class="table table-bordered" style="background: white">
        <thead>
        <tr style="background: #6FA5DB">
            <th width="50">ID</th>
            <th>模块编号</th>
            <th>模块名称(菜单名)</th>
            <th>该模块(菜单)相关的网页</th>
            <th>模块链接的网页</th>
            <th>模块图标</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $sql="select  *  from  qx_rule";
        $result=$db->db_select_array($sql); //执行查询，读二维数组
        foreach ($result as  $key=>$value){ //对每一行(二维数组的每一行  记成  下标=>值)
            ?>
            <tr>
                <td> <?php  echo  $value["id"]; ?> </td>
                <td> <?php  echo  $value["ruleId"]; ?> </td>
                <td> <?php  echo  $value["ruleName"]; ?> </td>
                <td> <?php  echo  $value["moduleName"]; ?> </td>
                <td> <?php  echo  $value["menuLink"]; ?> </td>
                <td> <?php  echo  $value["iconClass"]; ?> </td>
            </tr>
            <?php
        }  //foreach  因为中间<tr></tr>不是php语言，所以不能放在PHP里
        ?>
        </tbody>
    </table>
</div>
</body>
</html>















