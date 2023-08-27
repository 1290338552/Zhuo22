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
 $sql="select * from category";     //用于动态绑定类别下拉选项的
 $result=$db->db_select_array($sql); //读二维数组（多行多列的类别)

 $id=$_GET['id']; //id是地址栏传来的
 $sqlS="select * from shop where id=$id "; //读取被修改的记录
 $resultS=$db->db_select_oneRow($sqlS);
?>
<form action="shopSave.php?action=update&id=<?php echo $id ?>" method="post" name="Form" enctype="multipart/form-data">
    <div style="margin-left: auto;margin-right: auto;width: 400px; height: 650px; text-align: center;"> <!--页面居中-->
      <div style="width: 200px;text-align: left;"><span style="font-family:'Yu Gothic Light';font-size:40px;color: #748f62;text-align: left;width: 100px;">Shop  IN </span></div>
      <div style="width: 500px; height:auto;background-color: white;">
          <div style="width: 500px;height: 40px; border-bottom: 1px solid #7c7b7d;padding-top: 10px;margin-bottom: 20px;">
              <div style="width: 110px;height:38px;color: #333333;margin-left:auto; margin-right: auto;text-align: center; border-bottom: 3px solid #434343;">商 品 编 辑</div>
          </div>
          <div style="width: 400px;text-align: left;margin-left: 50px;">
              <input  type="text" name="shopNo" value="<?php echo $resultS['shopNo']?>"  placeholder="商品编号" required style="padding-left: 30px; background:url(images/person.jpg) no-repeat left  center;height: 40px;width: 260px;"><br/><br/>
              <input  type="text" name="shopName" value="<?php echo $resultS['shopName']?>" placeholder="商品名称" required style="padding-left: 30px; background:url(images/person.jpg) no-repeat left  center;height: 40px;width: 260px;"><br/><br/>
              <select name="categoryNo" required style="padding-left: 30px; height: 40px;width: 260px;">
                  <option value="">--- 请选择商品类别 ---</option>
                  <?php
                   foreach ($result as $key=>$item){  //对$result的每一行  当成  下标=>内容   内容就是一行记录
                  ?>
                       <option value="<?php echo $item['categoryNo'] ?>" <?php if($resultS['categoryNo']==$item['categoryNo']) echo 'selected'; ?> > <?php echo $item['categoryName']?> </option>
                  <?php
                   }
                  ?>
              </select> <br/><br/>

              <input  type="text" name="shopMoney" value="<?php echo $resultS['shopMoney']?>" placeholder="商品单价" required style="padding-left: 30px; background:url(images/person.jpg) no-repeat left  center;height: 40px;width: 260px;"><br/><br/>



              <input name="BImgpath" value="<?php echo $resultS['shopPicture']?>" type="text" size="30" readonly="readonly" />
              <input name="SImgpath" type="hidden" readonly="readonly" />
              <?
              $img_w=100;  //生成小图宽
              $img_h=100;//生成小图高
              $img_z=1; //是否生成缩略图0不生成,1生成
              ?>
              <iframe src="upload.php?action=edit&img=<?php echo $resultS['BImgpath']?>&simg=<?php echo $resultS['BImgpath']?>&imgsize=1&img_w=100&img_h=100" width="90%" height="39" scrolling="No" frameborder="0" style="border:0px;"></iframe><br/><br/>

              <textarea name="shopDescp" id="shopDescp" style="width:99%;height:350px;visibility:hidden;"> <?php echo $resultS['shopDescp']?> </textarea> <br/>

              <input  type="text" name="remark" value="<?php echo $resultS['remark']?>" placeholder="备注" style="padding-left: 30px; background:url(images/person.jpg) no-repeat left  center;height: 40px;width: 260px;"><br/><br/>
          </div>
          <div style="width: 400px;text-align: right;">
               <input  type="submit" value="保&nbsp;&nbsp;存" style="height: 40px; width: 100px; border-radius: 5px;background-color: #759063;font-size: 16px;color: white;margin-right: 60px;" ><br/><br/>
          </div>
      </div>
    </div>
</form>
</body>
</html>


























