<?php
// 执行商品信息的增删改查操作

// 导入配置文件和函数库文件
require("dbconfig.php");
require("functions.php");

// 连接mysql，选择数据库
//$link = mysql_connect(HOST, USER, PASS) or die("数据库失败!");
//mysql_select_db(DBNAME, $link);

// 获取action参数的值，并做对应的操作。
switch($_GET["action"]) {
    case "add":
        // 获取添加信息
        $name = $_POST["name"];
        $note = $_POST["note"];
        $typeid = $_POST["typeid"];
        $price = $_POST["price"];
        $total = $_POST["total"];
        // TODO:验证参数
        // 执行上传
        $upinfo = uploadFile("pic", "./uploads/");
        if($upinfo["error"] === false) {
            die("图片上传失败:".$upinfo["info"]);
        } else {
            $pic = $upinfo["info"]; // 获取上传成功的图片名
        }
        // 执行图片缩放
        imageUpdateSize("./uploads/".$pic, 50, 50);
        // sql
        $addtime = date("Y-m-d h:i:s", time());
        $sql = "insert into goods values(null,'{$name}','{$typeid}',{$price},{$total},'{$pic}','{$note}','{$addtime}')";
        echo "sql:".$sql;
        break;
    case "del":
        break;
    case "update":
        break;
}

// 关闭数据库
//mysql_close($link);