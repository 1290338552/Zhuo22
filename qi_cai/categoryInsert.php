<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="CSS/CSS.css">

</head>
<body style="background-color: #f3f3f3">
<form action="categorySave.php?action=insert" method="post" name="Form" enctype="multipart/form-data" >
    <div style="margin-left: auto;margin-right: auto;width: 400px; height: 650px; text-align: center;"> <!--页面居中-->
      <div style="width: 300px;text-align: left;"><span style="font-family:'Yu Gothic Light';font-size:40px;color: #748f62;text-align: left;width: 100px;">CATEGORY  IN </span></div>
      <div style="width: 400px; height: auto;background-color: white;">
          <div style="width: 400px;height: 40px; border-bottom: 1px solid #7c7b7d;padding-top: 10px;margin-bottom: 20px;">
              <div style="width: 110px;height:38px;color: #333333;margin-left: auto;margin-right: auto;text-align: center; border-bottom: 3px solid #434343;">类别添加</div>
          </div>
          <div style="width: 400px;text-align: left;margin-left: 50px;">
              <input  type="text" name="categoryNo" placeholder="类别编号" required style="padding-left: 30px; background:url(images/person.jpg) no-repeat left  center;height: 40px;width: 260px;"><br/><br/>
              <input  type="text" name="categoryName" id="passWord" placeholder="类别名称" required style="padding-left:30px;background:url(images/lock.jpg) no-repeat left  center;height: 40px;width: 260px; "><br/><br/>


          </div>
          <div style="width: 400px;text-align: right;">
               <input  type="submit" value="添&nbsp;&nbsp;加" style="height: 40px; width: 100px; border-radius: 5px;background-color: #759063;font-size: 16px;color: white;margin-right: 60px;" ><br/><br/>
          </div>
      </div>
    </div>
</form>
</body>
</html>















