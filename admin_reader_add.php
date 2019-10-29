<?php
session_start();
$userid=$_SESSION['userid'];
include ('mysqli_connect.php');


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="http://cdn.static.runoob.com/libs/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="http://cdn.static.runoob.com/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="http://cdn.static.runoob.com/libs/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <title>도서관 || 사용자 증가</title>
</head>
<body>
<nav class="navbar navbar-default navbar-static-top" role="navigation">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">도서관 관리 시스템</a>
        </div>
        <div>
            <ul class="nav navbar-nav">
                <li ><a href="admin_index.php">홈페이지</a></li>
                <li class="active" class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">서적 관리<b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="admin_book.php">모든 서적</a></li>
                        <li><a href="admin_book_add.php">서적 증가</a></li>

                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">사용자 관리<b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="admin_reader.php">모든 사용자</a></li>
                        <li><a href="admin_reader_add.php">사용자 증가</a></li>
                    </ul>
                </li>
                <li><a href="admin_borrow_info.php">대출관리</a></li>
                <li><a href="admin_repass.php">암호 수정</a></li>
                <li><a href="index.php">로그아웃</a></li>
            </ul>
        </div>
    </div>
</nav>
<h1 style="text-align: center"><strong>사용자</strong></h1>
<div style="padding: 10px 500px 10px;">
    <form  action="admin_reader_add.php" method="POST" style="text-align: center" class="bs-example bs-example-form" role="form">
        <div id="login">
            <div class="input-group"><span class="input-group-addon">读者证号</span><input name="nid" type="text" placeholder="请输入读者证号" class="form-control"></div><br/>
            <div class="input-group"><span class="input-group-addon">读者姓名</span><input name="nname" type="text" placeholder="请输入读者姓名" class="form-control"></div><br/>
            <div class="input-group"><span class="input-group-addon">性别</span><input name="nsex" type="text" placeholder="请输入读者性别" class="form-control"></div><br/>
            <div class="input-group"><span class="input-group-addon">读者生日</span><input name="nbirth" type="text" placeholder="请输入读者生日" class="form-control"></div><br/>
            <div class="input-group"><span class="input-group-addon">读者地址</span><input name="naddress" type="text" placeholder="请输入读者地址" class="form-control"></div><br/>
            <div class="input-group"><span class="input-group-addon">读者电话</span><input name="ntel" type="text" placeholder="请输入读者电话" class="form-control"></div><br/>
            <input type="submit" value="添加" class="btn btn-default">
            <input type="reset" value="重置" class="btn btn-default">
        </div>
    </form>
</div>
<?php

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    $nnid = $_POST["nid"];
    $nnam= $_POST["nname"];
    $nsex = $_POST["nsex"];
    $nbir= $_POST["nbirth"];
    $nadd= $_POST["naddress"];
    $nnte = $_POST["ntel"];


    $sqla="insert into reader_info VALUES ($nnid ,'{$nnam}','{$nsex}','{$nbir}','{$nadd}','{$nnte}')";
    $sqlb="insert into reader_card (reader_id,name) VALUES($nnid ,'{$nnam}');";
    $resa=mysqli_query($dbc,$sqla);
    $resb=mysqli_query($dbc,$sqlb);


    if($resa==1&&$resb==1)
    {

        echo "<script>alert('读者添加成功！初始密码为111111')</script>";
        echo "<script>window.location.href='admin_reader.php'</script>";

    }
    else
    {
        echo "<script>alert('添加失败！请重新输入！');</script>";

    }

}


?>
</body>
</html>
