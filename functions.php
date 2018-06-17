<?php
/*
公共函数库文件：图片信息的上传、等比缩放等操作
*/

/**
 * 文件上传处理函数
 * @param string filename 要上传的文件表单项名
 * @param string $path 上传的文件的保存路径
 * @param array 允许的文件类型
 * @return array 两个单元: ["error"] false:失败，true:成功
 *                       ["info] 存放失败原因或成功的文件名
 */
function uploadFile($filename, $path, $typelist=null) {
    // 获取上传文件的名字
    $upfile = $_FILES[$filename];
    if(empty($typelist)) {
        $typelist = array("image/gif", "image/jpg", "image/jpeg", "image/png"); // 允许的文件类型
    }
    // $path = "upload3"; // 指定上传文件的保存路径（相对的）
    $res = array("error"=>false); // 存放返回的错误
    // 过滤上传文件的错误号
    if($upfile["error"] > 0) {
        switch($upfile["error"]) {
            case 1:
                $res["info"] = "上传的文件超出了限制";
                break;
            case 2:
                $res["info"] = "上传的文件的大小超出了限制";
                break;
            case 3:
                $res["info"] = "文件部分被上传";
                break;
            case 4:
                $res["info"] = "没有文件被上传";
                break;
            case 6:
                $res["info"] = "找不到临时文件夹";
                break;
            default:
                $res["info"] = "未知错误";
                break;
        }
        return $res;
    }
    // 本次文件大小的限制
    if($upfile["size"] > 100000) {
        $res["info"] = "上传文件过大";
        return $res;
    }
    // 过滤类型
    if(!in_array($upfile["type"], $typelist)) {
        $res["info"] = "上传文件类型不符".$upfile["type"];
        return $res;
    }
    //初始化信息（未图片产生一个随机的名字）
    $fileinfo = pathinfo($upfile["name"]);
    do{
        $newfile = date("YmdHIs").rand(1000, 9999).".".$fileinfo["extension"];
    } while(file_exists($newfile));
    //执行上传处理
    if(is_uploaded_file($upfile["tmp_name"])) {
        if(move_uploaded_file($upfile["tmp_file"], $path."/".$newfile)) {
            $res["info"] = $newfile;
            $res["error"] = true;
            return $res;
        } else {
            $res["info"] = "上传文件失败";
        }
    } else {
        $res["info"] = "不是一个上传的文件";
    }
    return $res;
}