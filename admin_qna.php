<?php
session_start();
$userid=$_SESSION['userid'];
include ('mysqli_connect.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>도서관 ||질문 관리</title>
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
                <li  class="dropdown" >
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">공지 관리<b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="admin_notice.php">모든 공지</a></li>
                        <li><a href="admin_notice_add.php">공지 추가</a></li>

                    </ul>
                <li class="active" ><a href="admin_qna.php">질문 관리</a></li>
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
<h1 style="text-align: center"><strong>모든 질문</strong></h1>
<form  id="query" action="admin_qna.php" method="POST">
    <div id="query">
        <label ><input  name="qnaquery" type="text" value="0001" class="form-control" style="background-color: #e4e4e4" readonly ></label>
        <input type="submit" value="미처리문의조회" class="btn btn-default">
    </div>
</form>
</form>

<table  width='100%' class="table table-hover">
    <tr>
        <th>번호</th>
        <th>질문자</th>
        <th>제목</th>
        <th>시간</th>
        <th>대답자</th>
        <th>사젝</th>
    </tr>
    <?php

    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
    $gjc = $_POST["qnaquery"];

        $sql="select qna_id,title,push_time,question,answer,name,admin_name  from  reader_info,qna,admin where qna.reader_id=reader_info.reader_id and qna.admin_id=admin.admin_id and ( admin_name like '%{$gjc}%' or qna.admin_id like '%{$gjc}%')  ;";

    }
    else{
        $sql="select qna_id,title,push_time,question,answer,name,admin_name  from  reader_info,qna,admin where qna.reader_id=reader_info.reader_id and qna.admin_id=admin.admin_id ;";
    }


    $res=mysqli_query($dbc,$sql);
    foreach ($res as $row){
        echo "<tr>";
        echo "<td>{$row['qna_id']}</td>";
        echo "<td>{$row['name']}</td>";
        echo "<td><a target='_top' href='admin_qna_read.php?id={$row['qna_id']}'>{$row['title']}</a></td>";
        echo "<td>{$row['push_time']}</td>";
        echo "<td>{$row['admin_name']}</td>";
        echo "<td><a href='admin_qna_del.php?id={$row['qna_id']}'><img src='image/delete.png'></a></td>";
        echo "</tr>";
    };
    ?>
</table>
</body>
</html>