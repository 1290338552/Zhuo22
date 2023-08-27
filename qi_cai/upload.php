<?php

if(isset($_POST['upimg'])) {
	set_time_limit(0);
	@header('Content-type: text/html;charset=UTF-8');
	$img_w=isset($_GET["img_w"])?$_GET["img_w"]:100;  //生成缩略图宽
	$img_h=isset($_GET["img_h"])?$_GET["img_w"]:100; //生成缩略图高
	$imgsize=isset($_GET["imgsize"])?$_GET["imgsize"]:100; //是否生成缩略图宽
	$form="form1"; //表单名
	$text="img"; //字段表
	$pos="uploadfile/"; //上传路径
	$url="upload.php?action=add";
	$curMonth=substr((string)date('Y-m-d'),0,7);
	if(!is_dir($pos)){
		echo "文件夹 \"{$pos}\"不存在  << <a href='{$url}'>返回</a>";
		exit;
	}
	//上传文件类型列表
	$uptypes=array(
	 'image/jpg',  						
	 'image/jpeg',
	 'image/png',
	 'image/pjpeg',
	 'image/gif',
	 'image/bmp',
	 'application/x-shockwave-flash',
	 'image/x-png',
	 'application/msword',
	 'audio/x-ms-wma',
	 'audio/mp3',
	 'application/vnd.rn-realmedia',
	 'application/x-zip-compressed',
	 'application/octet-stream',
	 'application/pdf'
	 );
	
	$max_file_size=20000000;   							//上传文件大小限制, 单位BYTE
	$path_parts=pathinfo($_SERVER['PHP_SELF']); 		//取得当前路径
	$destFolder=$pos.$curMonth."/"; 					//上传文件路径
	$watermark=0;   									//是否附加水印(1为加水印,其他为不加水印);
	$watertype=1;   									//水印类型(1为文字,2为图片)
	$waterposition=3;   								//水印位置(1为左下角,2为右下角,3为左上角,4为右上角,5为居中);
	$waterstring="oppl"; 				            		//水印字符串
	$waterimg="xplore.gif";  							//水印图片
	$imgpreview=0;   									//是否生成预览图(1为生成,其他为不生成);
	$imgpreviewsize=1/2;  								//缩略图比例
	$Imagesthumb=$imgsize;                                 //生成缩略图 (1生成,0不生成)
	$RESIZEWIDTH=$img_w;                                   // 生成图片的宽度
	$RESIZEHEIGHT=$img_w;                                  // 生成图片的高度
	
	//是否存在文件
	//if (!is_uploaded_file($_FILES["upfile"][tmp_name]))
	if(isset($_FILES["upfile"]))
	 if(!is_uploaded_file($_FILES["upfile"][tmp_name]))
	{
		echo "<font color='red'>文件不存在</font> << <a href='{$url}'>返回</a>";
		exit;
	}
	 $file =isset($_FILES["upfile"])?$_FILES["upfile"]:NULL;
	  //检查文件大小
	 if($max_file_size < $file["size"])
	 {
		 echo "<font color='red'>文件太大了</font> << <a href='{$url}'>返回</a>";
		 exit;
	  }
	
	//检查文件类型
	if(isset($file["type"]))
	  if(!in_array($file["type"], $uptypes))
	{
		 echo "<font color='red'>非法文件类型</font> << <a href='{$url}'>返回</a>";
		 exit;
	}
	
	if(!is_dir($destFolder)){
		mkdir($destFolder);
		chown($destFolder,0777);
	}
	$filename=isset($file["tmp_name"])?$file["tmp_name"]:NULL;
    if($filename)	$image_size = getimagesize($filename);
	$pinfo=isset($file["name"])?pathinfo($file["name"]):NULL;;
	if($pinfo) $ftype=$pinfo[extension]; else $ftype="jpg";
	$imagename = time();
	$destination = $destFolder.$imagename.".".$ftype;
	//if($pinfo) $destination = $destFolder.$imagename.".".$ftype;
	//  else $destination = $destFolder.$imagename.".jpg";
	$thumb = $destFolder.$imagename.".thumb.".$ftype;
	$destPath=$curMonth."/".$imagename.".".$ftype;
	$thumbPath=$curMonth."/".$imagename.".thumb.".$ftype;
			
		// 生成缩略图
	if ($Imagesthumb==1) {
			$FILENAME=$pos.$thumbPath;  //生成缩略图地址
			function ResizeImage($im,$maxwidth,$maxheight,$name){ 
			$width = imagesx($im); 
			$height = imagesy($im); 
			if(($maxwidth && $width > $maxwidth) || ($maxheight && $height > $maxheight)){ 
			if($maxwidth && $width > $maxwidth){ 
			$widthratio = $maxwidth/$width; 
			$RESIZEWIDTH=true; 
			} 
			if($maxheight && $height > $maxheight){ 
			$heightratio = $maxheight/$height; 
			$RESIZEHEIGHT=true; 
			} 
			if($RESIZEWIDTH && $RESIZEHEIGHT){ 
			if($widthratio < $heightratio){ 
			$ratio = $widthratio; 
			}else{ 
			$ratio = $heightratio; 
			} 
			}elseif($RESIZEWIDTH){ 
			$ratio = $widthratio; 
			}elseif($RESIZEHEIGHT){ 
			$ratio = $heightratio; 
			} 
			$newwidth = $width * $ratio; 
			$newheight = $height * $ratio; 
			if(function_exists("imagecopyresampled")){ 
			
			$newim = imagecreatetruecolor($newwidth, $newheight); 
			imagecopyresampled($newim, $im, 0, 0, 0, 0, $newwidth, $newheight, $width, $height); 
			}else{ 
			$newim = imagecreate($newwidth, $newheight); 
			imagecopyresized($newim, $im, 0, 0, 0, 0, $newwidth, $newheight, $width, $height); 
			} 
			ImageJpeg ($newim,$name ); 
			ImageDestroy ($newim); 
			}else{ 
			ImageJpeg ($im,$name ); 
			} 
			} 
			
			if($_FILES['upfile']['size']){ 
			if($_FILES['upfile']['type'] == "image/pjpeg"){ 
			$im = imagecreatefromjpeg($_FILES['upfile']['tmp_name']); 
			}elseif($_FILES['upfile']['type'] == "image/x-png"){ 
			$im = imagecreatefrompng($_FILES['upfile']['tmp_name']); 
			}elseif($_FILES['upfile']['type'] == "image/gif"){ 
			$im = imagecreatefromgif($_FILES['upfile']['tmp_name']); 
			} 
			if($im){ 
			//if(file_exists("$FILENAME.jpg")){ 
			//unlink("$FILENAME.jpg"); 
			//} 
			ResizeImage($im,$RESIZEWIDTH,$RESIZEHEIGHT,$FILENAME);
			ImageDestroy ($im); 
			} 
			} 
		}
	//生成缩略图结束
	if(!move_uploaded_file ($filename, $destination))
	{
		echo "<font color='red'>上传出错</font> << <a href='{$url}'>返回</a>";
		exit;
	}else{
			//加水印	
			if($watermark==1)
			{
			$iinfo=getimagesize($destination,$iinfo);
			$nimage=imagecreatetruecolor($image_size[0],$image_size[1]);
			$white=imagecolorallocate($nimage,255,255,255);
			$black=imagecolorallocate($nimage,0,0,0);
			$red=imagecolorallocate($nimage,255,0,0);
			imagefill($nimage,0,0,$white);
			switch ($iinfo[2])
			{
			case 1:
			$simage =imagecreatefromgif($destination);
			break;
			case 2:
			$simage =imagecreatefromjpeg($destination);
			break;
			case 3:
			$simage =imagecreatefrompng($destination);
			break;
			case 6:
			$simage =imagecreatefromwbmp($destination);
			break;
			default:
			die("<font color='red'>不能上传此类型文件！</a>");
			exit;
			}
			
			imagecopy($nimage,$simage,0,0,0,0,$image_size[0],$image_size[1]);
			imagefilledrectangle($nimage,1,$image_size[1]-15,80,$image_size[1],$white);
			
			switch($watertype)
			{
			case 1: //加水印字符串
			imagestring($nimage,2,3,$image_size[1]-15,$waterstring,$black);
			break;
			case 2: //加水印图片
			$simage1 =imagecreatefromgif("xplore.gif");
			imagecopy($nimage,$simage1,0,0,0,0,85,15);
			imagedestroy($simage1);
			break;
			}
			
			switch ($iinfo[2])
			{
			case 1:
			//imagegif($nimage, $destination);
			imagejpeg($nimage, $destination);
			break;
			case 2:
			imagejpeg($nimage, $destination);
			break;
			case 3:
			imagepng($nimage, $destination);
			break;
			case 6:
			imagewbmp($nimage, $destination);
			//imagejpeg($nimage, $destination);
			break;
			}
			//生成水印覆盖原上传文件
			imagedestroy($nimage);
			imagedestroy($simage);
			}
		//上传成功返回值
		header("Location:?action=edit&img={$destPath}&simg={$thumbPath}&imgsize={$imgsize}&img_w={$img_w}&img_h={$img_h}");
 		exit();
		}
}
if ($_GET["action"]=="add") {

?>
<script src="js/ImageMin.js"></script>
<script src="js/ImagePreview.js"></script>
<table width="100%" height="42" border="0" cellpadding="0" cellspacing="0">
  <form action="" method="post"  name="imgform" enctype="multipart/form-data">
  <tr>
    <td width="350">	<input type="file" name="upfile" id="idFile">
  	<input type="submit" name="upimg" value="上&nbsp;传"/></td>
	<td><img id="idImg" style="display:none;" /></td>
  </tr>
  </form> 
</table>
<script>
var ip = new ImagePreview( $$("idFile"), $$("idImg"), {
	maxWidth: 40, maxHeight: 40, action: ""
});
ip.img.src = ImagePreview.TRANSPARENT;
ip.file.onchange = function(){ ip.preview(); };
</script>
<?php
	if (isset($_GET["img"])&& $_GET["img"]!=false){
	//图片重传,删除原图
	unlink("UploadFile/".$_GET["img"]."");
//	unlink("UploadFile/".$_GET["simg"]."");
	}
}
if ($_GET["action"]=="edit") {
//下面的JS是把上传路径传递到数据页面文本框中,请注意form1表单名,要和修改或插入页面的表单名相同
?>
<script type="text/javascript">
parent.document.Form.BImgpath.value='<?=$_GET["img"]?>';
parent.document.Form.SImgpath.value='<?=$_GET["simg"]?>'</script>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="4%"><img name="" src="UploadFile/<?=$_GET["img"]?>" height="40" alt=""></td>
    <td width="96%"><a href='upload.php?action=add&img=<?=$_GET["img"]?>&simg=<?=$_GET["simg"]?>&imgsize=<?=$_GET["imgsize"]?>&img_w=<?=$_GET["img_w"]?>&img_h=<?=$_GET["img_h"]?>'>重新上传</a></td>
  </tr>
</table>
<?php
}?>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style type="text/css">
<!--
body {
margin-left: 0px;
margin-top: 0px;
margin-right: 0px;
margin-bottom: 0px;
font-size:12px
}
input{ border:1px solid #ccc;}
textarea{ border:1px solid #ccc;}
form{padding:0px;margin:0px}
a{font-size:12px; text-decoration:none}
-->
</style>
	