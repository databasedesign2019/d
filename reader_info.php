<?php
session_start();
$userid=$_SESSION['userid'];
include ('mysqli_connect.php');

$sql="select name from reader_card where reader_id={$userid}";
$res=mysqli_query($dbc,$sql);
$result=mysqli_fetch_array($res);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>마이 도서관||개인정보</title>
    <link rel="stylesheet" href="http://cdn.static.runoob.com/libs/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="http://cdn.static.runoob.com/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="http://cdn.static.runoob.com/libs/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style>
        body{
            width: 100%;
            overflow: hidden;
            background: url("bg.jpg") no-repeat;
            background-size:cover;
            color: antiquewhite;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-default navbar-static-top" role="navigation">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">마이 도서관</a>
        </div>
        <div>
            <ul class="nav navbar-nav">
                <li ><a href="reader_index.php">홈페이지</a></li>
                <li><a href="reader_querybook.php">도서 조회</a></li>
                <li ><a href="reader_borrow.php">마이 대출</a></li>
                <li class="active"><a href="reader_info.php">개인 정보</a></li>
                <li><a href="reader_repass.php">암호 수정</a></li>
                <li><a href="reader_guashi.php">분실신고</a></li>
                <li><a href="index.php">로그아웃</a></li>
            </ul>
        </div>
    </div>
</nav>
    <?php



    $sqla="select * from reader_info where reader_id={$userid} ;";

    $resa=mysqli_query($dbc,$sqla);
    $resulta=mysqli_fetch_array($resa);
    ?>
<div class="col-xs-5 col-md-offset-3" style="position: relative;top: 25%;text-align: center">
<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title">마이 정보</h3>
    </div>
    <div class="panel-body">
        <a href="#" class="list-group-item"><?php echo "<p>사용자 번호:{$resulta['reader_id']}</p><br/>"; ?></a>
        <a href="#" class="list-group-item"><?php  echo "<p>성함:{$resulta['name']}</p><br/>";  ?></a>
        <a href="#" class="list-group-item"><?php    echo "<p>성별:{$resulta['sex']}</p><br/>"; ?></a>
        <a href="#" class="list-group-item"><?php echo "<p>생일:{$resulta['birth']}</p><br/>";  ?></a>
        <a href="#" class="list-group-item"><?php     echo "<p>주소:{$resulta['address']}</p><br/>";  ?></a>
        <a href="#" class="list-group-item"><?php    echo "<p>전화:{$resulta['telcode']}</p><br/>"; ?></a>
        <?php echo "<a style='color: #AA0000;font-size: larger' href='reader_info_edit.php'><strong>수정하기</strong></a>"; ?>
    </div>
</div>
</div>


</body>
</html>