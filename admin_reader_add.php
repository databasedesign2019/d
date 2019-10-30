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
            <nav class="navbar navbar-default navbar-static-top" role="navigation">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <a class="navbar-brand" href="#">도서관 관리 시스템</a>
                    </div>
                    <div>
                        <ul class="nav navbar-nav">
                            <li ><a href="admin_index.php">홈페이지</a></li>
                            <li class="dropdown" class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">서적 관리<b class="caret"></b>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a href="admin_book.php">모든 서적</a></li>
                                    <li><a href="admin_book_add.php">서적 추가</a></li>

                                </ul>
                            </li>
                            <li class="active">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">사용자 관리<b class="caret"></b>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a href="admin_reader.php">모든 사용자</a></li>
                                    <li><a href="admin_reader_add.php">사용자 추가</a></li>
                                </ul>
                            </li>
                            <li><a href="admin_borrow_info.php">대출관리</a></li>
                            <li><a href="admin_repass.php">암호 수정</a></li>
                            <li><a href="index.php">로그아웃</a></li>
            </ul>
        </div>
    </div>
</nav>
<h1 style="text-align: center"><strong>사용자 추가</strong></h1>
<div style="padding: 10px 500px 10px;">
    <form  action="admin_reader_add.php" method="POST" style="text-align: center" class="bs-example bs-example-form" role="form">
        <div id="login">
            <div class="input-group"><span class="input-group-addon">사용자 번호</span><input name="nid" type="text" placeholder="사용자 번호 입력하시오" class="form-control"></div><br/>
            <div class="input-group"><span class="input-group-addon">사용자 성명</span><input name="nname" type="text" placeholder="성명 입력하시오" class="form-control"></div><br/>
            <div class="input-group"><span class="input-group-addon">성별</span><input name="nsex" type="text" placeholder="성별 입력하시오" class="form-control"></div><br/>
            <div class="input-group"><span class="input-group-addon">생일</span><input name="nbirth" type="text" placeholder="생일 입력하시오" class="form-control"></div><br/>
            <div class="input-group"><span class="input-group-addon">주소</span><input name="naddress" type="text" placeholder="주소 입력하시오" class="form-control"></div><br/>
            <div class="input-group"><span class="input-group-addon">휴데전화</span><input name="ntel" type="text" placeholder="전화 입력하시오" class="form-control"></div><br/>
            <input type="submit" value="추가" class="btn btn-default">
            <input type="reset" value="리셋" class="btn btn-default">
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

        echo "<script>alert('사용자 추가 성공! 초기 암호 111111')</script>";
        echo "<script>window.location.href='admin_reader.php'</script>";

    }
    else
    {
        echo "<script>alert('추가 실패! 다시 입력하십시오!');</script>";

    }

}


?>
</body>
</html>
