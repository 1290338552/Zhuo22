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

</head>
<p style="background-color: #f3f3f3">
<form action="jueseSave.php?action=insert" method="post" name="Form" enctype="multipart/form-data" >
    <div style="margin-left: auto;margin-right: auto;width: 400px; height: auto; text-align: center;"> <!--页面居中-->
      <div style="width: 300px;text-align: left;"><span style="font-family:'Yu Gothic Light';font-size:40px;color: #748f62;text-align: left;width: 100px;">Role  IN </span></div>
      <div style="width: 400px; height: auto;background-color: white;">
          <div style="width: 400px;height: 40px; border-bottom: 1px solid #7c7b7d;padding-top: 10px;margin-bottom: 20px;">
              <div style="width: 110px;height:38px;color: #333333;margin-left: auto;margin-right: auto;text-align: center; border-bottom: 3px solid #434343;">角色添加</div>
          </div>
          <div style="width: 400px;text-align: left;margin-left: 50px;">
              <input  type="text" name="jueseId" placeholder="角色编号" required style="padding-left: 30px; background:url(images/person.jpg) no-repeat left  center;height: 40px;width: 260px;"><br/><br/>
              <input  type="text" name="jueseName" id="passWord" placeholder="角色名称" required style="padding-left:30px;background:url(images/lock.jpg) no-repeat left  center;height: 40px;width: 260px; "><br/><br/>


          </div>
          <div style="width: 400px;text-align: right;">
               <input  type="submit" value="添&nbsp;&nbsp;加" style="height: 40px; width: 100px; border-radius: 5px;background-color: #759063;font-size: 16px;color: white;margin-right: 60px;" ><br/><br/>
          </div>
      </div>
    </div>
</form>
<p align="center" style="font-size: 19px;color: red;">已有的角色编号、角色名称如下，请勿重复：</p>
<div class="panel-body">

<table class="table table-bordered">
    <thead>
    <tr>
        <th width="50">ID</th>
        <th>角色编号</th>
        <th>角色名称</th>
    </tr>
    </thead>
    <tbody>
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
    //?>
    <?php
    $sql="select  *  from  qx_juese";
    $result=$db->db_select_array($sql); //执行查询，读二维数组
    foreach ($result as  $key=>$value){ //对每一行(二维数组的每一行  记成  下标=>值)
        ?>
        <tr>
            <td> <?php  echo  $value["id"]; ?> </td>
            <td> <?php  echo  $value["jueseId"]; ?> </td>
            <td> <?php  echo  $value["jueseName"]; ?> </td>
        </tr>
        <?php
    }  //foreach  因为中间<tr></tr>不是php语言，所以不能放在PHP里
    ?>
    </tbody>
</table>
</div>
</body>
</html>















