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

    <title>Home</title>
    <script>if(top!=window) window.top.location.href=window.location.href;</script>
</head>
<body>

<!-- Backgrounds -->

<div id="login-bg" style="background-image: url('./images/12.jpg');" class="container-fluid">


</div>

<!-- End Backgrounds -->

<div class="container" id="login">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="login">

                <h1>登录</h1>

                <!-- Loging form -->
                <form action="loginSave.php" method="post">
                    <div class="form-group">
                        <input type="text" name="userName" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="请输入用户名" required>
                    </div>
                    <div class="form-group">
                        <input type="password" name="passWord" class="form-control" id="exampleInputPassword1" placeholder="请输入密码" required>
                    </div>
                    <div class="form-group" style="text-align: left">
                        <input type="text" name="VCode" class="form-control-sm" size="25" placeholder="请输入验证码" required>
                        <img src="inc/GetCode.php" onclick="javascript:this.src='inc/GetCode.php'" width="60" height="40" alt="验证码">
                    </div>

                    <div class="form-check">

                        <label class="switch">
                            <input type="checkbox">
                            <span class="slider round"></span>
                        </label>
                        <label class="form-check-label" for="exampleCheck1">记住我</label>

                        <label class="forgot-password"><a href="findPassword.php">忘记密码?<a> </label>

                    </div>

                    <br>
                    <button type="submit" class="btn btn-lg btn-block btn-success">登录</button>
                </form>
                <!-- End Loging form -->

            </div>Copyright &copy; 2019.Company name All rights reserved.<a target="_blank" href="http://sc.chinaz.com/moban/">&#x7F51;&#x9875;&#x6A21;&#x677F;</a>
        </div>
    </div>
</div>


</body>
</html>