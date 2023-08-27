<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>用户列表-页面演示 zui-admin</title>
    <!-- zui css -->
    <link rel="stylesheet" href="dist/css/zui.min.css">
    <link rel="stylesheet" href="dist/theme/blue.css">
    <!-- app css -->
    <link rel="stylesheet" href="css/app.css">
    <!-- jquery js -->
    <script src="dist/lib/jquery/jquery.js"></script>
    <script type="text/javascript">
        function DelInfo()
        {
            if(confirm("确定要删除此信息吗？"))
                return true;
            else
                return false;
        }
        //批量删除信息提示
        function DelAllInfo()
        {
            if(confirm("确定要批量删除这些信息吗？"))
                return true;
            else
                return false;
        }
        //checkbox选中事件
        function CheckAll(){
            //设置变量form的值为name等于select的表单
            var form=document.DelForm
            //取得触发事件的按钮的name属性值
            var action=event.srcElement.name
            for (var i=0;i<form.elements.length;i++){//遍历表单项
                //将当前表单项form.elements[i]对象简写为e
                var e = form.elements[i]
                //如果当前表单项的name属性值为iTo，
                //执行下一行代码。限定脚本处理的表单项范围。
                if (e.name == "DelBox[]")
                    /*如果单击事件发生在name为selectall的按钮上，就将当前表单项的checked属性设为true(即选中)，否则设置为当前设置的相反值(反选)*/
                    e.checked =(action=="selectall")?(form.selectall.checked):(!e.checked)
            }
        }
    </script>
    <style>
        .content-wrapper{
            margin: 0;
            padding: 0;
        }
    </style>
</head>

<body>
  <form action="userJueseSave.php?action=DelAll" method="post" name="DelForm" >
    <div class="wrapper">
        <div class="content-wrapper">
            <div class="content-header">
                <ul class="breadcrumb">
                    <li><a href="#"><i class="icon icon-home"></i></a></li>
                    <li><a href="#">页面演示</a></li>
                    <li class="active">用户列表</li>
                </ul>
            </div>
            <div class="content-body">
                <div class="container-fluid">
                    <div class="panel">
                        <div class="panel-heading">
                            <div class="panel-title">类别列表</div>
                        </div>
                        <div class="panel-body">
                            <div class="table-tools" style="margin-bottom: 15px;">
                                <div class="pull-right" style="width: 250px;">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="关键字">
                                        <span class="input-group-btn">
                                            <button class="btn btn-default" type="button">搜索</button>
                                        </span>
                                    </div>
                                </div>
                                <div class="tools-group">
                                    <a href="userJueseInsert.php" class="btn btn-primary"><i class="icon icon-plus-sign"></i> 新增</a>
                                    <a href="#" class="btn btn-success"><i class="icon icon-check-circle"></i> 启用</a>
                                    <a href="#" class="btn btn-warning"><i class="icon icon-ban-circle"></i> 禁用</a>

<!--                                    <input type="submit" value="批量删除" class="btn btn-danger"-->
<!--                                           style="background-image: url('images/del2.png'); background-repeat: no-repeat;padding-left: 30px; ">-->

                                    <a href="#" class="btn btn-danger" onclick="document.DelForm.submit()"><i class="icon icon-remove-sign"></i> 批量删除</a>
                                </div>
                            </div>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>用户名</th>
                                        <th>拥有的角色列表</th>
                                        <th>操作</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                include "inc/power.php";
                                $menuModule=$quanXian->getMenuModule();
                                $hasPower=false;
                                foreach ($menuModule as $item){
                                    if(in_array($quanXian->php_self(),explode('|',$item["moduleName"])) )
                                        $hasPower=true;
                                }
                                //if(!$hasPower){
                                //    echo "<script> alert('您没有权限访问此模块，请联系管理员！'); window.location.href='index.php'; </script>";
                                //    return;
                                //}

                                   $sql="select distinct userName  from  v_userJuese order by userName";
                                   $result=$db->db_select_array($sql); //执行查询，读二维数组
                                   foreach ($result as  $key=>$item){ //对每一行(二维数组的每一行  记成  下标=>值)
                                       $sql2="select *  from  v_userJuese where userName='{$item['userName']}' order by userName,jueseId";
                                       $result2=$db->db_select_array($sql2); //mysqli_num_rows($result2); 居然没有用
                                       $sql3="select count(userName) as rows  from  v_userJuese where userName='{$item['userName']}' order by userName,jueseId";
                                       $result3=$db->db_select_oneRow($sql3);
                                       $rows=$result3["rows"];
                                       $i=0;
                                       foreach ($result2 as $key=>$value){
                                          if($i==0){
                                   ?>
                                              <tr>
                                                  <td rowspan="<?=$rows?>" width="100" align="center"> <?php  echo  $value["userName"]; ?> </td>
                                                  <td width="300"> <?php  echo  $value["jueseName"]; ?> </td>
                                                  <td rowspan="<?=$rows?>" width="60">
                                                      <a href="userJueseUpdate.php?id=<?php  echo  $value["userName"]; ?>" class="btn btn-xs btn-primary">编辑</a>
                                                  </td>
                                              </tr>
                                   <?php
                                          } else{
                                   ?>
                                              <tr>
                                                  <td> <?php  echo  $value["jueseName"]; ?> </td>
                                              </tr>
                                    <?php
                                          }
                                          $i++;
                                       }
                                    }  //foreach
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div> 
    </div>


    <!-- zui js -->
    <script src="dist/js/zui.min.js"></script>
    <!-- app js -->
    <script src="js/app.js"></script>
  </form>
</body>
</html>