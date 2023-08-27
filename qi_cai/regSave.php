<?php

    include  "inc/DbClass.php"; //包含数据库操作类
    $action=$_GET["action"]; //地址栏传来的必须（只能）用get接收。 易错处
//var_dump($action);//看看action收到没？测试完后必须删除或注释。输出和json冲突
    if($action=="insert"){ //注册
                //接收用户名、密码
                $userName=$_POST["userName"];
                $passWord=$_POST["passWord"];
                $phone=$_POST["phone"];
                $email=$_POST["email"];
                $birthday=$_POST["birthday"];
                $nationNo=$_POST["nationNo"];
                $sex=$_POST["sex"];
                $ArticleContent=$_POST["ArticleContent"];
                $BImgpath=$_POST["BImgpath"];
        //做条SQL语句，并执行
                $sql="INSERT INTO `userinfo`(`userName`, `passWord`, `phone`, `email`, `birthday`, `nationNo`, `sex`, `ArticleContent`, `BImgpath`)
                   VALUES ('{$userName}', '{$passWord}', '{$phone}', '{$email}', '{$birthday}', '{$nationNo}', '{$sex}', '{$ArticleContent}', '{$BImgpath}')";
                $result=$db->db_insert_delete_update($sql); //调用完成增删改方法
echo $sql;
        //判断成功？ 成功：提示，跳转到主页。  失败：提示用户名或密码错。后退
            if($result){
                echo "<script> alert('注册成功！');  window.location.href='login.php';  </script>";
            }else{
                echo "<script> alert('注册失败！');  window.history.back();  </script>";
            }

    }
    else if($action=="isRepeat"){ //判断用户名重复不？
        $userName1=$_POST["userName1"]; //Ajax用post方式传数据
        $sql="select * from userinfo where userName='$userName1' ";
        $result=$db->db_select_oneRow($sql);
        if($result){
            $data=[ "code"=>1 ];  //如果有记录，说明是重复，给回1
        }else{
            $data=[ "code"=>0 ];  //否则无记录，说明是可用，给回0
        }
        echo json_encode($data);  //en表示编码  其他任何输出都屏蔽
    }

