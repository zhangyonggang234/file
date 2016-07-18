<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016-7-18
 * Time: 16:00
 */
header("Content-type:text/html;charset=utf-8");


$allType=array("gif","png","jpg","jpeg");
$temp=explode(".",$_FILES["file"]["name"]);
// 生成随机文件名函数
function random($length){
    $captchaSource = "0123456789abcdefghijklmnopqrstuvwxyz这是一个随机打印输出字符串的例子";
    $captchaResult = "2016"; // 随机数返回值
    $captchaSentry = ""; // 随机数中间变量
    for($i=0;$i<$length;$i++){
        $n = rand(0, 35); #strlen($captchaSource));
        if($n >= 36){
            $n = 36 + ceil(($n-36)/3) * 3;
            $captchaResult .= substr($captchaSource, $n, 3);
        }else{
            $captchaResult .= substr($captchaSource, $n, 1);
        }
    }
    return $captchaResult;
}
if((($_FILES["file"]["name"]=="image/img")||
    ($_FILES["file"]["name"]=="image/jpeg")||
    ($_FILES["file"]["type"]=="image/ipg")||
    ($_FILES["file"]["type"]=="image/png"))&& in_array(end($temp),$allType)&&($_FILES["file"]["size"]<(1024*1024))){
    if($_FILES["file"]["error"]){
        echo$_FILES["file"]["error"];
    }else{
        if(!is_dir("./upload/")){
            mkdir("./upload/");
        }
        if(file_exists("./upload/".$_FILES["file"]["name"])){
echo"文件存在";
        }else{
            $uploadfilename = random(8);
            move_uploaded_file($_FILES["file"]["tmp_name"],"./upload/".$uploadfilename.$_FILES["file"]["name"]);
            echo"上传成功";
        }
    }
}
//存储可以上传到服务器的文件类型
//$allowExts=array("gif","png","jpg","png");
////取出文件名和后缀名
//$temp=explode(".",$_FILES["file"]["name"]);
//print_r($temp);
//echo end($temp);
//if((($_FILES["file"]["type"]=="image/gif")||
//    ($_FILES["file"]["type"]=="image/jpeg")||
//    ($_FILES["file"]["type"]=="image/ipg")||
//    ($_FILES["file"]["type"]=="image/png"))&& in_array(end($temp),$allowExts)&&($_FILES["file"]["size"]<(1024*1024))){
//    if($_FILES["file"]["error"]){
//        echo"error".$_FILES["file"]["error"];
//    }
//    else{
//        //判断是否存在upload文件夹
//        if(!is_dir("./upload/")){
//            mkdir("./upload/");
//        }
//        //判断在upload文件下是否有同名文件,如果停止上传,没有就上传文件
//        if(file_exists("./upload/".$_FILES["file"]["name"])){
//            echo"文件存在";
//        }else{
//            move_uploaded_file($_FILES["file"]["tmp_name"],"./upload/".$_FILES["file"]["name"]);
//            echo"文件已上传";
//        }
//    }
//}