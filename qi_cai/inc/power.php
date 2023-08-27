<?php
include "DbClass.php";

class QuanXian  {

    var $phpself;  //本文件被包含于其他需要验证权限的各个网页。$phpself就是每个网页自己的名字
    var $jueseIds; //登录的用户有哪些角色（属于哪些组）
    var $ruleIds;  //组有哪些规则
    var $menus;    //有哪些菜单
    var $db;
    function __construct(){
        $this->db=new DbClass();
        $this->db->db_connect();
    }
    function getJuese(){//一、查看用户 有哪些角色
        $sql="select distinct jueseId from qx_userjuese where userName='{$_SESSION["userName"]}'";
        $result=$this->db->db_select_array($sql);
        $jueseIds="";
        foreach ($result as $key=>$item){ //把角色id拼合成  j001,j002,j005,j007
            $jueseIds .="'".$item["jueseId"]."',";
        }
        if(strlen($jueseIds)>1) $jueseIds=substr($jueseIds,0,strlen($jueseIds)-1);//去掉最后 逗号
        return $jueseIds;
    }
    function getRule(){//二、对每一个角色查询其规则、去重
        if(!$this->getJuese()) return false;
        $sql="select distinct ruleId from qx_jueserule where jueseId in ({$this->getJuese()}) order by ruleId";
        $result=$this->db->db_select_array($sql);
        $ruleIds="";
        foreach ($result as $key=>$item){ //把角色id拼合成  j001,j002,j005,j007
            $ruleIds .="'".$item["ruleId"]."',";
        }
        if(strlen($ruleIds)>1) $ruleIds=substr($ruleIds,0,strlen($ruleIds)-1);
        return $ruleIds;
    }
    function getMenuModule(){//三、对每一个规则，查询其菜单名，以及模块名，如果当前访问的页面在模块名列表中，表示有权限，可以访问，否则返回
        if(!$this->getRule()) return false;
        $sql="select  * from qx_rule where  ruleId in ({$this->getRule()}) order by ruleId";
        $result=$this->db->db_select_array($sql);
        return $result;
    }

    function php_self(){
        $php_self=substr($_SERVER['PHP_SELF'],strrpos($_SERVER['PHP_SELF'],'/')+1);
        return $php_self;
    }
    //$phpself=php_self();
    //  echo $phpself;
};
$quanXian=new QuanXian();
//
//$_SESSION["userName"]="admin";
//
//var_dump($quanXian->getMenuModule());
//$quanXian->getMenuModule();


