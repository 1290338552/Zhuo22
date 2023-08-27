
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="CSS/CSS.css">

    <link rel="stylesheet" href="inc/kindeditor/themes/default/default.css" />
    <link rel="stylesheet" href="inc/kindeditor/plugins/code/prettify.css" />
    <script charset="utf-8" src="inc/kindeditor/kindeditor.js"></script>
    <script charset="utf-8" src="inc/kindeditor/lang/zh_CN.js"></script>
    <script charset="utf-8" src="inc/kindeditor/plugins/code/prettify.js"></script>
    <!-- jquery js -->
    <script src="dist/lib/jquery/jquery.js"></script>
    <script>
        KindEditor.ready(function(K) {
            var editor = K.create('textarea[name="introduction"]', {
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

<form action="borrowuserSave.php?action=insert" method="post" name="Form" enctype="multipart/form-data" >
    <div style="margin-left: auto;margin-right: auto;width: 400px; height: 650px; text-align: center;"> <!--页面居中-->
        <div style="width: 300px;text-align: left;"><span style="font-family:'Yu Gothic Light';font-size:40px;color: #748f62;text-align: left;width: 100px;">CATEGORY  IN </span></div>
        <div style="width: 400px; height: auto;background-color: white;">
            <div style="width: 400px;height: 40px; border-bottom: 1px solid #7c7b7d;padding-top: 10px;margin-bottom: 20px;">
                <div style="width: 110px;height:38px;color: #333333;margin-left: auto;margin-right: auto;text-align: center; border-bottom: 3px solid #434343;">借用人添加</div>
            </div>
            <div style="width: 400px;text-align: left;margin-left: 50px;">
                <input  type="text" name="nameNo" placeholder="借用人编号" required style="padding-left: 30px; background:url(images/person.jpg) no-repeat left  center;height: 40px;width: 260px;"><br/><br/>
                <input  type="text" name="nameName" id="passWord" placeholder="借用人姓名" required style="padding-left:30px;background:url(images/lock.jpg) no-repeat left  center;height: 40px;width: 260px; "><br/><br/>


            </div>
            <div style="width: 400px;text-align: right;">
                <input  type="submit" value="添&nbsp;&nbsp;加" style="height: 40px; width: 100px; border-radius: 5px;background-color: #759063;font-size: 16px;color: white;margin-right: 60px;" ><br/><br/>
            </div>
        </div>
    </div>
</form>
</body>
</html>















