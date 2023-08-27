<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>角色列表-页面演示 zui-admin</title>
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
?>
<body>
<form action="jueseSave.php?action=DelAll" method="post" name="DelForm" >
    <div class="wrapper">
        <div class="content-wrapper">
            <div class="content-header">
                <ul class="breadcrumb">
                    <li><a href="#"><i class="icon icon-home"></i></a></li>
                    <li><a href="#">页面演示</a></li>
                    <li class="active">角色列表</li>
                </ul>
            </div>
            <div class="content-body">
                <div class="container-fluid">
                    <div class="panel">
                        <div class="panel-heading">
                            <div class="panel-title">角色列表</div>
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
                                    <a href="jueseInsert.php" class="btn btn-primary"><i class="icon icon-plus-sign"></i> 新增</a>
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
                                    <th width="30">
                                        <input type="checkbox" name="DelAll" onclick="CheckAll()" />
                                    </th>
                                    <th width="50">ID</th>
                                    <th>角色编号</th>
                                    <th>角色名称</th>
                                    <th>启用/禁用</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                //                                   include "inc/Dbclass.php";
                                $sql="select  *  from  qx_juese order by id";
                                $result=$db->db_select_array($sql); //执行查询，读二维数组
                                foreach ($result as  $key=>$value){ //对每一行(二维数组的每一行  记成  下标=>值)
                                    ?>
                                    <tr>
                                        <td>  <input type="checkbox" name="DelBox[]" value="<?php echo $value['id']?>" /> </td>
                                        <td> <?php  echo  $value["id"]; ?> </td>
                                        <td> <?php  echo  $value["jueseId"]; ?> </td>
                                        <td> <?php  echo  $value["jueseName"]; ?> </td>
                                        <td>
                                            <?php
                                            if($value["active"]!=''&&$value["active"]!=null&&$value["active"]!=0){
                                                ?>
                                                <a href="javascript:disable('<?php  echo  $value["id"]; ?>');" class="btn btn-mini btn-success"><i class="icon icon-ok-circle"></i>启用</a>
                                                <?php
                                            }else{
                                                ?>
                                                <a href="javascript:enable('<?php  echo  $value["id"]; ?>');" class="btn btn-mini btn-danger"><i class="icon icon-remove-sign"></i>禁用</a>
                                                <?php
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <a href="jueseUpdate.php?id=<?php  echo  $value["id"]; ?>" class="btn btn-xs btn-primary">编辑</a>
                                            <a href="jueseSave.php?action=delete&id=<?php  echo  $value["id"]; ?>" class="btn btn-xs btn-danger">删除</a>
                                        </td>
                                    </tr>
                                    <?php
                                }  //foreach  因为中间<tr></tr>不是php语言，所以不能放在PHP里
                                ?>
                                </tbody>
                            </table>

                            <div id="dataGrid" class="datagrid datagrid-striped">
                                <div class="datagrid-container"></div>
                                <div class="pager"></div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</form>
</body>
<!-- jquery js -->
<script src="dist/lib/jquery/jquery.js"></script>
<!-- zui js -->
<script src="dist/js/zui.min.js"></script>
<!-- app js -->
<script src="js/app.js"></script>
<script>
    function enable(id) {
        if(id) {
            $.ajax({
                url: "jueseSave.php?action=active",
                async: true,
                type: "POST",
                data: {id: id,isActive: 1},
                success: function (res) {
                    if ($.type(res) === "string") {
                        res = $.parseJSON(res);//Json解码
                    }
                    console.log(res); //没用，测试看回传
                    // showMsg('提示', res.msg, 5, 'chat', 3);
                    if (res.code == 1) {
                        window.location.href = res.url; //刷新页面
                    }
                }
            });
        }
    }
    function disable(id) {
        if(id) {
            $.ajax({
                url: "jueseSave.php?action=active",
                async: true,
                type: "POST",
                data: {id: id,isActive: 0},
                success: function (res) {
                    if ($.type(res) === "string") {
                        res = $.parseJSON(res);
                    }
                    console.log(res);
                    // showMsg('提示', res.msg, 5, 'chat', 3);
                    if (res.code == 1) {
                        window.location.href = res.url;
                    }
                }
            });
        }
    }
</script>
</html>