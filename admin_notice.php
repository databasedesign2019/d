<?php
session_start();
$userid=$_SESSION['userid'];
include ('mysqli_connect.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>도서관 ||공지 관리</title>
    <link rel="stylesheet" href="http://cdn.static.runoob.com/libs/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="http://cdn.static.runoob.com/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="http://cdn.static.runoob.com/libs/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style>
        body{
            width: 100%;
            height:auto;

        }
        #query{
            text-align: center;
        }
    </style>
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
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">서적 관리<b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="admin_book.php">모든 서적</a></li>
                        <li><a href="admin_book_add.php">서적 추가</a></li>

                    </ul>
                </li>
                <li class="active" class="dropdown" >
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">공지 관리<b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="admin_notice.php">모든 공지</a></li>
                        <li><a href="admin_notice_add.php">공지 추가</a></li>
                    </ul>
                </li>
                <li class="dropdown">
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
<h1 style="text-align: center"><strong>모든 공지</strong></h1>
<form  id="query" action="admin_notice.php" method="POST">
    <div id="query">
        <label ><input  name="bookquery" type="text" placeholder="공지 제목이나  번호를 입력하십시오" class="form-control"></label>
        <input type="submit" value="조회" class="btn btn-default">
    </div>
</form>

<table  width='100%' class="table table-hover">
    <tr>
        <th>번호</th>
        <th>제목</th>
        <th>시간</th>
        <th>내용</th>
        <th>구분호</th>
        <th>구분</th>
        <th>조작</th>
        <th>조작</th>
    </tr>
    <?php

    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
    $gjc = $_POST["bookquery"];

        $sql="select noid,title,time,content,nc_id,nc_name from notice,notice_class where notice.nc_id=notice_class.nc_id and ( title like '%{$gjc}%' or noid like '%{$gjc}%')  ;";

    }
    else{
        $sql="select noid,title,time,content,notice.nc_id,nc_name  from  notice,notice_class where notice.nc_id=notice_class.nc_id ;";
    }


    $res=mysqli_query($dbc,$sql);
    foreach ($res as $row){
        echo "<tr>";
        echo "<td>{$row['noid']}</td>";
        echo "<td>{$row['title']}</td>";
        echo "<td>{$row['time']}</td>";
        echo "<td>{$row['content']}</td>";
        echo "<td>{$row['nc_id']}</td>";
        echo "<td>{$row['nc_name']}</td>";
        echo "<td><a href='admin_notice_edit.php?id={$row['noid']}'>수정</a></td>";
        echo "<td><a href='admin_notice_del.php?id={$row['noid']}'>삭제</a></td>";
        echo "</tr>";
    };
    ?>
</table>
</body>
</html>