<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="CSS/CSS.css">

</head>
<body style="background-color: #f3f3f3">
<form action="jueseruleSave.php?action=insert" method="post" name="Form" enctype="multipart/form-data" >
    <div style="margin-left: auto;margin-right: auto;width: 400px; height: 650px; text-align: center;"> <!--页面居中-->
        <div style="width: 300px;text-align: left;"><span style="font-family:'Yu Gothic Light';font-size:40px;color: #748f62;text-align: left;width: 100px;">User TO Role  IN </span></div>
        <div style="width: 400px; height: auto;background-color: white;">
            <div style="width: 400px;height: 40px; border-bottom: 1px solid #7c7b7d;padding-top: 10px;margin-bottom: 20px;">
                <div style="width: 110px;height:38px;color: #333333;margin-left: auto;margin-right: auto;text-align: center; border-bottom: 3px solid #434343;">为角色修改模块权限</div>
            </div>
            <div style="width: 400px;text-align: left;margin-left: 50px;">
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
                $jueseId=$_GET["jueseId"];
                $sql="select * from qx_juese";
                $qx_juese=$db->db_select_array($sql); //读二维数组（多行多列的类别)
                $sql="select * from qx_rule";
                $qx_rule=$db->db_select_array($sql);
                ?>
                <select name="jueseId" id="jueseId999" required style="padding-left: 30px; height: 40px;width: 260px;">
                    <option value="">--- 请选择用户 ---</option>
                    <?php
                    foreach ($qx_juese as $key=>$item){  //对$result的每一行  当成  下标=>内容   内容就是一行记录
                        if($item['jueseId']==$jueseId)
                            echo  "<option value='{$item['jueseId']}' selected> {$item['jueseName']} </option>";
                        else
                            echo  "<option value='{$item['jueseId']}'> {$item['jueseName']} </option>";
                    }
                    ?>
                </select> <br/><br/>
                <div id="ruleId999">
                    <?php
                    $sql="select distinct ruleId from qx_jueserule  where jueseId='$jueseId'  ";
                    $qx_jueserule=$db->db_select_array($sql);
                    $sql="select * from qx_rule";
                    $qx_rule=$db->db_select_array($sql);
                    //形成带勾选的角色多选框（把选择的这个用户 已有的权限勾选）
                    $option="";
                    foreach ($qx_rule as $key=>$item){
                        if(in_array($item['ruleId'],array_column($qx_jueserule,'ruleId'))){
                            $option.="<input type='checkbox' name='ruleId[]' value='{$item['ruleId']}' checked > {$item['ruleName']} <br/>" ; //如果该用户原先已有该角色，勾选
                        }else{
                            $option.="<input type='checkbox' name='ruleId[]' value='{$item['ruleId']}' checked > {$item['ruleName']} <br/>" ; //否则，不勾选
                        }
                    }
                    echo $option;
                    ?>
                </div>

            </div>
            <div style="width: 400px;text-align: right;">
                <br/><input  type="submit" value="确&nbsp;&nbsp;定" style="height: 40px; width: 100px; border-radius: 5px;background-color: #759063;font-size: 16px;color: white;margin-right: 60px;" ><br/><br/>
            </div>
        </div>
    </div>
</form>
</body>
</html>

<script src="dist/lib/jquery/jquery.js"></script>

<script>
    $(function () {
        $("#jueseId999").change(function () { //当省选项改变了。触发
            $.ajax({
                url: "jueseruleSave.php?action=JueseToRule",
                async: true,
                type: "post",
                data: {jueseId: $("#jueseId999").val()},
                success: function (res) { //调用返回后，做的工作
                    res = JSON.parse(res); //把返回的参数，先解码
                    $("#ruleId999").html(res); //找到城市下拉，把返回的选项加上去
                }
            })
        });
    });
</script>