<!doctype html>
<html lang="en">
<head>
<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<!-- Bootstrap CSS -->
<link rel="stylesheet" href="CSS/bootstrap.min.css">

<!-- Loding font -->
<!--<link href="https://fonts.googleapis.com/css?family=Montserrat:300,700" rel="stylesheet">-->

<!-- Custom Styles -->
<link rel="stylesheet" type="text/css" href="CSS/styles.css">
	<link rel="stylesheet" href="inc/kindeditor/themes/default/default.css" />
	<link rel="stylesheet" href="inc/kindeditor/plugins/code/prettify.css" />
	<script charset="utf-8" src="inc/kindeditor/kindeditor.js"></script>
	<script charset="utf-8" src="inc/kindeditor/lang/zh_CN.js"></script>
	<script charset="utf-8" src="inc/kindeditor/plugins/code/prettify.js"></script>
	<script>
		KindEditor.ready(function(K) {
			var editor = K.create('textarea[name="ArticleContent"]', {
				cssPath : 'inc/kindeditor/plugins/code/prettify.css',
				uploadJson : 'inc/kindeditor/php/upload_json.php',
				fileManagerJson : 'inc/kindeditor/php/file_manager_json.php',
				allowFileManager : true,
				afterFocus : function () {   //在光标定位在编辑器内
					  if(editor.html()=="请输入简历..."){   //如果有提示字，就清空
						  editor.html('');
					  }
				},
				afterBlur : function () {    //当光标离开编辑器之后，触发
					 if(editor.html()==''){  //如果还没输入内容，就提示
						 editor.html("请输入简历...");
					 }
				}
			});
		});      //百度： 在线编辑器  提示  allowFileManager : true 。中国有14亿人口，你碰到的问题，别人早就碰到了，搜答案
	</script>
    <script>if(top!=window) window.top.location.href=window.location.href;</script>
<title>Home</title>
	<script>
		function  check(){
			var passWord1=document.getElementById("passWord1").value;
			var passWord2=document.getElementById("passWord2").value;
			// alert(passWord1);//中途测试，看看取值
			if(passWord1 != passWord2){
				alert("两次密码不一致！");
				document.getElementById("passWord1").focus();  //光标定位到密码框。人性化
				return  false; //返回假，不能提交表单
			}
			return  true;//前面都没返回假，表单合格，可以提交
		}
	</script>
</head>
<body>
<?php
include "inc/DbClass.php";
// $sql="select * from test";
// $category=$db->db_select_array($sql); //读二维数组（多行多列的类别)
//
//$sql="select * from province";
//$province=$db->db_select_array($sql); //读二维数组（多行多列的类别)

$sql="select * from nation";
$nation=$db->db_select_array($sql); //读二维数组（多行多列的类别)

//$sql="select * from name";
//$name=$db->db_select_array($sql); //读二维数组（多行多列的类别)

?>
<!-- Backgrounds -->

<div id="login-bg" class="container-fluid">

  <div class="bg-img"></div> <!-- 左半面绿叶背景 -->
  <div class="bg-color"></div><!-- 右半面浅绿色 -->
</div>

<!-- End Backgrounds -->

<div class="container" id="login">
	<div class="row justify-content-center">
	<div class="col-lg-8">
	  <div class="login">

		<h1>注册</h1>
		
		<!-- Loging form -->
			  <form  action="regSave.php?action=insert" method="post" name="Form" onsubmit="return  check()">
				<div class="form-group">
				  <input type="text" name="userName" class="form-control" id="userName1" aria-describedby="emailHelp" placeholder="请输入用户名" required>
                    <label id="userNameLabel"></label>
				</div>
				<div class="form-group">
				  <input type="password" name="passWord" class="form-control" id="passWord1" placeholder="请输入密码" required>
				</div>
				<div class="form-group">
				  <input type="password" name="passWord" class="form-control" id="passWord2" placeholder="请输入确认密码" required>
				</div>
				<div class="form-group">	<!-- 正则表达式来约束以1开头的11位数字就是手机号。参考教材95页。用的时候去百度 -->
				  <input type="text" name="phone" class="form-control" id="phone" pattern="^1\d{10}$" aria-describedby="emailHelp" placeholder="请输入11位手机号" required>
				</div>
				  <div class="form-group">
					  <input type="email" name="email" class="form-control" id="email1" aria-describedby="请输入生日" placeholder="请输入邮箱" required>
				  </div>
				  <div class="form-group">
					  <input type="date" name="birthday" class="form-control" id="birthday1" aria-describedby="请输入生日" placeholder="请输入生日" required>
				  </div>
<!--				  <div class="form-group">-->
<!--					  <select name="nationNo" class="custom-select" >-->
<!--						  <option value="hanzu">汉族</option>-->
<!--						  <option value="zhuangzu">壮族</option>-->
<!--						  <option value="miaozu">苗族</option>-->
<!--						  <option value="yizu">彝族</option>-->
<!--					  </select>-->
<!--				  </div>-->

                  <select name="nationNo" required style="padding-left: 30px; height: 40px;width: 260px;">
                      <option value="">--- 请选择归还人 ---</option>
                      <?php
                      foreach ($nation as $key=>$item){  //对$result的每一行  当成  下标=>内容   内容就是一行记录
                          echo  "<option value='{$item['nationName']}'> {$item['nationName']} </option>";
                      }
                      ?>
                  </select> <br/><br/>

				  <div class="form-group" style="text-align: left"> <!--1、设好的样式：左对齐 2、style="text-align:left"  -->
				 性别： <input type="radio" name="sex" class="custom-radio" value="男" > 男 &nbsp;&nbsp;
					   <input type="radio" name="sex" class="custom-radio" value="女" > 女
				  </div>

				  <div class="form-group" style="text-align: left">
					  <textarea name="ArticleContent" id="ArticleContent" style="width:99%;height:350px;visibility:hidden;"> 请输入简历... </textarea>
				  </div>

				  <div class="form-group" style="text-align: left">
					 图片路径：<input name="BImgpath" type="text" size="30" readonly="readonly" />
					          <input name="SImgpath" type="hidden" readonly="readonly" />
				  </div>
				  <div class="form-group" style="text-align: left">
					 上传头像：
					  <?php
						$img_w=100;  //生成小图宽
						$img_h=100;//生成小图高
						$img_z=1; //是否生成缩略图0不生成,1生成
					  ?>
					  <iframe src="upload.php?action=add&imgsize=1&img_w=100&img_h=100" width="90%" height="39" scrolling="No" frameborder="0" style="border:0px;"></iframe>
				  </div>


				  <div class="form-check">

				  <label class="switch">
				  <input type="checkbox">
				  <span class="slider round"></span>
				</label>
				  <label class="form-check-label" for="exampleCheck1">记住我</label> <!-- 利用cookie在本机记录填过的用户名、密码 -->
				  
				  <label class="forgot-password"><a href="findPassword.php">联系我们！<a></label>

				</div>
			  
				<br>
				<button type="submit" class="btn btn-lg btn-block btn-success">注册</button>
			  </form>
		 <!-- End Loging form -->

	  </div>Copyright &copy; 2019.Company name All rights reserved.<a target="_blank" href="http://sc.chinaz.com/moban/">&#x7F51;&#x9875;&#x6A21;&#x677F;</a>
	</div>
	</div>
</div>

<!-- 引入几个js支持文件。然后用Ajax无刷新技术，去后端验证用户名重复不？ -->
<script  src="dist/lib/jquery/jquery.js"></script>
<script  src="dist/js/zui.min.js"></script>
<script  src="js/app.js"></script>
<script  src="static/zui/js/common.js"></script>

<script>
    $(function () {
        $("#userName1").blur(function () {   //$("#userName1")表示选择了id="userName1"的用户名文本框。blur()表示光标离开时触发
             // alert("触发了？");//步步为营。看看触发没有？
             // 用Ajax无刷新技术：把用户名传给后端，后端去数据库查询有无？给回 1重复  0可用
             $.ajax({
                  url:"regSave.php?action=isRepeat", //相当于地址栏跳转
                  type:"post",   //传数据的方式用post
                  async:true,    //同步。步调一致。
                  data:{userName1:$("#userName1").val() }, //传过去的数据格式—— 变量:值
                  success:function (res) {   //调用成功后，返回，要做的事情。返回的结果用res接收
                      res=JSON.parse(res);   //进行JSON解码
                      if(res.code==1){
                          $("#userNameLabel").html('<img src="images/del.png">');
                           //alert("用户名重复！"); //提示重复
                      }else{
                          $("#userNameLabel").html('<img src="images/envelop.jpg">');
                          // alert("用户名可用！"); //提示可用
                      }
                  }
             })
        })
    })
</script>

</body>
</html>














