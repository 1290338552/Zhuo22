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
                <div class="alert alert-warning alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <p>页面演示仅供参考，可自行修改</p>
                </div>
                <div class="panel">
                    <div class="panel-heading">
                        <div class="panel-title">供应商信息列表</div>
                    </div>
                    <div class="panel-body">
                        <div class="table-tools" style="margin-bottom: 15px;">
                            <div class="pull-right" style="width: 250px;">
                                <div class="input-group">
                                    <!--② 建个表单，和下面表单平行 -->        <form action="supplierinfoList.php" name="SearchForm" method="post">
                                        <!--③ 给个名字 -->                      <input type="text" name="key"  class="form-control" placeholder="关键字" style="width: 180px">
                                        <span class="input-group-btn">
  <!--  ④ 单击事件，让表单提交 -->                 <button class="btn btn-default" onclick="document.SearchForm.submit()" type="button">搜索</button>
                                            </span>
                                    </form>
                                </div>
                            </div>
                            <div class="tools-group">
                                <a href="supplierinfoInsert.php" class="btn btn-primary"><i class="icon icon-plus-sign"></i> 新增</a>
                                <!--                                    <a href="#" class="btn btn-success"><i class="icon icon-check-circle"></i> 启用</a>-->
                                <!--                                    <a href="#" class="btn btn-warning"><i class="icon icon-ban-circle"></i> 禁用</a>-->
                                <!---->
                                <!--                                    <input type="submit" value="批量删除" class="btn btn-danger"-->
                                <!--                                           style="background-image: url('images/del2.png'); background-repeat: no-repeat;padding-left: 30px; ">-->

                                <a href="#" class="btn btn-danger" onclick="document.DelForm.submit()"><i class="icon icon-remove-sign"></i> 批量删除</a>
                            </div>
                        </div>
                        <!-- ① 从56行移下来的-->   <form action="supplierinfoSave.php?action=DelAll" method="post" name="DelForm" >
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th width="30">
                                        <input type="checkbox" name="DelAll" onclick="CheckAll()" />
                                    </th>
                                    <th width="50">ID</th>
                                    <th>供应商编号</th>
                                    <th>供应商名称</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody>


                                <?php
                                include "inc/DbClass.php";
                                /*  ⑤   */                       $key=isset($_POST["key"]) ? $_POST["key"] : NULL ; //搜索框如果传来值。就接收，否则就是空
                                if($key){
                                    $sql="select  *  from  supplierinfo where supplierName  like '%{$key}%' ";  //用like模糊查询
                                }else{
                                    $sql="select  *  from  supplierinfo";  //无条件，读取所有记录
                                }
                                $result=$db->db_select_array($sql); //执行查询
                                foreach ($result as  $key=>$value){ //对每一行(二维数组的每行  记成  下标=>值)
                                    ?>
                                    <tr>
                                        <td>  <input type="checkbox" name="DelBox[]" value="<?php echo $value['id']?>" /> </td>
                                        <td> <?php  echo  $value["id"]; ?> </td>
                                        <td> <?php  echo  $value["supplierNo"]; ?> </td>
                                        <td> <?php  echo  $value["supplierName"]; ?> </td>
                                        <td>
                                            <a href="supplierinfoUpdate.php?id=<?php  echo  $value["id"]; ?>" class="btn btn-xs btn-primary">编辑</a>
                                            <a href="supplierinfoSave.php?action=delete&id=<?php  echo  $value["id"]; ?>" class="btn btn-xs btn-danger">删除</a>
                                        </td>
                                    </tr>
                                    <?php
                                }  //foreach  因为中间<tr></tr>不是php语言，所以不能放在PHP里
                                ?>
                                </tbody>
                            </table>
                        </form>
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

</body>
</html>