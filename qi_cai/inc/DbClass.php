<?php
class  DbClass
{
    var $severName="127.0.0.1";  //数据库的服务器名
    var $userName="root";        //连数据库服务器的用户名
    var $passWord="root";        //连数据库服务器的密码
    var $dataBase="sports";       //访问哪个数据库。考试时指定了数据库名，这里要换。
    var $conn=null;              //存连接用的，初始化为空

//    var $severName="127.0.0.1";  //数据库的服务器名
//    var $userName="root";        //连数据库服务器的用户名
//    var $passWord="osvplus3";        //连数据库服务器的密码
//    var $dataBase="gxjzy";       //访问哪个数据库。考试时指定了数据库名，这里要换。
//    var $conn=null;              //存连接用的，初始化为空

    //连接数据库服务器
    function  db_connect(){
        $this->conn=new mysqli($this->severName,$this->userName,$this->passWord,$this->dataBase,3306); //连服务器名，用户，密码，数据库
        if($this->conn->connect_error){                 //如果连接失败
             die("连接失败".$this->conn->connect_error); //给出提示
        }
        mysqli_set_charset($this->conn,"utf8"); //设置字符集，防止中文乱码
    }

    //增删改只返回受影响的行数（整数）
    function  db_insert_delete_update($sql){
         $result=$this->conn->query($sql);  //执行$sql语句
         return  $result;                   //如果语句执行不成功，返回0   0恰巧就是假   1、2、3……都是真值
    }
    //查询出多行多列（二维数组）
    function  db_select_array($sql){
        $result=$this->conn->query($sql);  //执行$sql语句
        $array=array();                    //定义个空数组
        while($row=$result->fetch_assoc()){ //用循环一行一行地读
            $array[]=$row;                  //把这行追加到数组里
        }
        return  $array;
    }
    //查询出一行（一维数组）
    function  db_select_oneRow($sql){
        $result=$this->conn->query($sql);  //执行$sql语句
        $row=$result->fetch_assoc();       //读出这行
        return $row;
    }
    //查询出记录数（整数）
    function  db_select_count($sql){
        $result=$this->conn->query($sql);  //执行$sql语句
        return  $result->num_rows;         //返回结果的行数
    }
} //到此，定义（设计）了一个类。如同设计了一款小汽车
$db=new DbClass();  //实例化。实实在在生产一辆小汽车，并且赋值（交付）给$db  以后就用$db
$db->db_connect();  //无论谁用，都会有统一操作：先连数据库

//测试，测完注释或删掉
//echo  $db->db_insert_delete_update("INSERT INTO `userinfo` (`xm`, `xh`, `mm`, `sex`) VALUES ('abcde', '123', '111', '男')");
