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
    <title>도서관 || 도서추가</title>
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
<h1 style="text-align: center"><strong>서적 층가</strong></h1>
<div style="padding: 10px 500px 10px;">
    <form  action="admin_book_add.php" method="POST" style="text-align: center" class="bs-example bs-example-form" role="form">
        <div id="login">
            <div class="input-group"><span class="input-group-addon">제목</span><input name="nname" type="text" placeholder="제목 입력하시오" class="form-control"></div><br/>
            <div class="input-group"><span class="input-group-addon">저자</span><input name="nauthor" type="text" placeholder="저자입력하시오" class="form-control"></div><br/>
            <div class="input-group"><span class="input-group-addon">출판사</span><input name="npublish" type="text" placeholder="출판사 입력하시오" class="form-control"></div><br/>
            <div class="input-group"><span class="input-group-addon">ISBN</span><input name="nISBN" type="text" placeholder="ISBN 입력하시오" class="form-control"></div><br/>
            <div class="input-group"><span class="input-group-addon">소개</span><input name="nintroduction" type="text" placeholder="소개 입력하시오" class="form-control"></div><br/>
            <div class="input-group"><span class="input-group-addon">언어</span><input name="nlanguage" type="text" placeholder="언어 입력하시오" class="form-control"></div><br/>
            <div class="input-group"><span class="input-group-addon">가격</span><input name="nprice" type="text" placeholder="가격 입력하시오" class="form-control"></div><br/>
            <div class="input-group"><span class="input-group-addon">출반 일기</span><input name="npubdate" type="text" placeholder="출반 일기 입력하시오" class="form-control"></div><br/>
            <div class="input-group"><span class="input-group-addon">구분 <select id="selector" select name="nclass_id"><option value="1">컴퓨터 과학</option><option value="2">철학</option><option value="3">사회 과학 </option><option value="4">정치 법률</option><option value="5">군사</option><option value="6">경제</option><option value="7">문화</option><option value="8">언어</option><option value="9">문학</option><option value="10">예술</option><option value="11">역사 지리</option><option value="12">자연 과학</option><option value="13">수리 과학과 화학</option><option value="14">천문학, 지구 과학</option><option value="15">생물과학</option><option value="16">의약, 위생</option><option value="17">농업과학</option><option value="18">공업 기술</option><option value="19">교통운수</option><option value="20">항공, 우주 비행</option><option value="21">환경 과학</option><option value="22">종합</option></select></span></div><br/>
            <div class="input-group"><span class="input-group-addon">책장호</span><input name="npressmark" type="text" placeholder="책장호 입력하시오" class="form-control"></div><br/>
            <div class="input-group"><span class="input-group-addon">상태 <select id="box" select name="nstate"><option value="0">대출중</option><option value="1">대출가능</option><option value="2">상태정보없음</option></select></span></div><br/>
            <label><input type="submit" value="추가" class="btn btn-default"></label>
            <label><input type="reset" value="리셋" class="btn btn-default"></label>
        </div>
    </form>
</div>
<?php

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    $nnam = $_POST["nname"];
    $naut = $_POST["nauthor"];
    $npubl = $_POST["npublish"];
    $nisb = $_POST["nISBN"];
    $nint = $_POST["nintroduction"];
    $nlan = $_POST["nlanguage"];
    $npri = $_POST["nprice"];
    $npubd = $_POST["npubdate"];
    $ncla = $_POST["nclass_id"];
    $npre = $_POST["npressmark"];
    $nsta= $_POST["nstate"];



    $sqla="insert into book_info VALUES (NULL ,'{$nnam}','{$naut}','{$npubl}','{$nisb}','{$nint}','{$nlan}','{$npri}','{$npubd}',{$ncla},{$npre},{$nsta} )";
    $resa=mysqli_query($dbc,$sqla);


    if($resa==1)
    {

        echo "<script>alert('추가 성공！')</script>";
        echo "<script>window.location.href='admin_book.php'</script>";

    }
    else
    {
        echo "<script>alert('추가 실패! 다시 입력해주세요！');</script>";

    }

}

?>
</body>
</html>
