<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="css/CSS.css">

    <link rel="stylesheet" href="inc/kindeditor/themes/default/default.css" />
    <link rel="stylesheet" href="inc/kindeditor/plugins/code/prettify.css" />
    <script charset="utf-8" src="inc/kindeditor/kindeditor.js"></script>
    <script charset="utf-8" src="inc/kindeditor/lang/zh_CN.js"></script>
    <script charset="utf-8" src="inc/kindeditor/plugins/code/prettify.js"></script>
    <!-- jquery js -->
    <script src="dist/lib/jquery/jquery.js"></script>
    <script>
        KindEditor.ready(function(K) {
            var editor = K.create('textarea[name="shopDescp"]', {
                cssPath : 'inc/kindeditor/plugins/code/prettify.css',
                uploadJson : 'inc/kindeditor/php/upload_json.php',
                fileManagerJson : 'inc/kindeditor/php/file_manager_json.php',
                allowFileManager : true,
                afterFocus:function () {                        //光标定位在文本编辑器里
                    if(editor.html()=='请在此输入商品简介……'){   //如果编辑器里是 这些字
                        editor.html('');                        //清空
                    }
                },
                afterBlur:function () {                              //当光标离开
                    if(editor.html()=='<br/>' || editor.html()==''){ //如果编辑器里只有回车 或者 空
                        editor.html('请在此输入商品简介……');          //给出提示
                    }
                }

            });
        });
    </script>

</head>
<body style="background-color: #f3f3f3">
<?php
 include "inc/DbClass.php";
// $sql="select * from test";
// $category=$db->db_select_array($sql); //读二维数组（多行多列的类别)
//
//$sql="select * from province";
//$province=$db->db_select_array($sql); //读二维数组（多行多列的类别)

$sql="select * from category";
$category=$db->db_select_array($sql); //读二维数组（多行多列的类别)
?>
<form action="shopSave.php?action=insert" method="post" name="Form" id="Form" enctype="multipart/form-data">
    <div style="margin-left: auto;margin-right: auto;width: 400px; height: 650px; text-align: center;"> <!--页面居中-->
      <div style="width: 200px;text-align: left;"><span style="font-family:'Yu Gothic Light';font-size:40px;color: #748f62;text-align: left;width: 100px;">Shop  IN </span></div>
      <div style="width: 500px; height:auto;background-color: white;">
          <div style="width: 500px;height: 40px; border-bottom: 1px solid #7c7b7d;padding-top: 10px;margin-bottom: 20px;">
              <div style="width: 110px;height:38px;color: #333333;margin-left:auto; margin-right: auto;text-align: center; border-bottom: 3px solid #434343;">商 品 添 加</div>
          </div>
          <div style="width: 400px;text-align: left;margin-left: 50px;">
              <input  type="text" name="shopNo" placeholder="商品编号" required style="padding-left: 30px; background:url(images/person.jpg) no-repeat left  center;height: 40px;width: 260px;"><br/><br/>
              <input  type="text" name="shopName" placeholder="商品名称" required style="padding-left: 30px; background:url(images/person.jpg) no-repeat left  center;height: 40px;width: 260px;"><br/><br/>
              <select name="categoryNo" required style="padding-left: 30px; height: 40px;width: 260px;">
                  <option value="">--- 请选择商品类别 ---</option>
                  <?php
                   foreach ($category as $key=>$item){  //对$result的每一行  当成  下标=>内容   内容就是一行记录
                       echo  "<option value='{$item['categoryNo']}'> {$item['categoryName']} </option>";
                   }
                  ?>
              </select> <br/><br/>

              <input  type="text" name="shopMoney" placeholder="商品单价" required style="padding-left: 30px; background:url(images/person.jpg) no-repeat left  center;height: 40px;width: 260px;"><br/><br/>



              <input name="BImgpath" type="hidden" size="30" readonly="readonly" />
              <input name="SImgpath" type="hidden" readonly="readonly" />
              <?
              $img_w=100;  //生成小图宽
              $img_h=100;//生成小图高
              $img_z=1; //是否生成缩略图0不生成,1生成
              ?>
              商品图片：<iframe src="upload.php?action=add&imgsize=1&img_w=100&img_h=100" width="90%" height="39" scrolling="No" frameborder="0" style="border:0px;"></iframe><br/><br/>


              <textarea name="shopDescp" id="shopDescp" style="width:99%;height:350px;visibility:hidden;">请在此输入商品简介……</textarea> <br/>
              <input  type="text" name="remark" placeholder="备注" style="padding-left: 30px; background:url(images/person.jpg) no-repeat left  center;height: 40px;width: 260px;"><br/><br/>
          </div>
          <div style="width: 400px;text-align: right;">
               <input  type="submit" value="添&nbsp;&nbsp;加" style="height: 40px; width: 100px; border-radius: 5px;background-color: #759063;font-size: 16px;color: white;margin-right: 60px;" ><br/><br/>
          </div>
      </div>
    </div>
</form>
<!-- jquery js -->
<script src="dist/lib/jquery/jquery.js"></script>
<!-- zui js -->
<script src="dist/js/zui.min.js"></script>
<!-- app js -->
<script src="js/app.js"></script>
<script src="static/zui/js/common.js"></script>
<script>
    $(function () {
        $("#province_no").change(function () {   //#province_no 选择器，选id=province_no那个标签。 change表示选项更改
             $.ajax({
                 url: "shopSave.php?action=provinceToCity",  //ajax的请求地址。还传了动作
                 async: true,
                 type: "POST",                      //以POST方式传输。后端要 $_POST['']
                 data: {province_no: $('#province_no').val() },  //传什么呢？ 传省编号
                 success: function (data) {
                     data=JSON.parse(data); //JSON格式数据的解析
                     $("#city_no").html(data); //把回来的选项，写在城市下拉列表下
                     $("#county_no").html('<option value="">请选县</option>');
                 }
             });
        });
        $("#city_no").change(function () {   //#province_no 选择器，选id=province_no那个标签。 change表示选项更改
            $.ajax({
                url: "shopSave.php?action=cityToCounty",  //ajax的请求地址。还传了动作
                async: true,
                type: "POST",                      //以POST方式传输。后端要 $_POST['']
                data: {city_no: $('#city_no').val() },  //传什么呢？ 传省编号
                success: function (data) {
                    data=JSON.parse(data); //JSON格式数据的解析
                    $("#county_no").html(data); //把回来的选项，写在城市下拉列表下
                }
            });
        });
    });
</script>
</body>
</html>


























