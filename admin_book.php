<?php
session_start();
$userid=$_SESSION['userid'];
include ('mysqli_connect.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>도서관 ||서적 관리</title>
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
                <li class="active" class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">서적 관리<b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="admin_book.php">모든 서적</a></li>
                        <li><a href="admin_book_add.php">서적 추가</a></li>
                    </ul>
                </li>
                <li class="dropdown" >
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">공지 관리<b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="admin_notice.php">모든 공지</a></li>
                        <li><a href="admin_notice_add.php">공지 추가</a></li>
                    </ul>
                <li  ><a href="admin_qna.php">질문 관리</a></li>
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
<h1 style="text-align: center"><strong>모든 서적</strong></h1>
<form  id="query" action="admin_book.php" method="POST">
    <div id="query">
        <label ><input  name="bookquery" type="text" placeholder="책 제목이나 책 번호를 입력하십시오" class="form-control"></label>
        <input type="submit" value="조회" class="btn btn-default">
    </div>
</form>

<table  width='100%' class="table table-hover">
    <tr>
        <th>번호</th>
        <th>제목</th>
        <th>저자</th>
        <th>출판사</th>
        <th>ISBN</th>
        <th>소개</th>
        <th>언어</th>
        <th> 값</th>
        <th>출판날짜</th>
        <th>구분호</th>
        <th>구분명</th>
        <th> 책장호</th>
        <th> 상태</th>
        <th>수정</th>
        <th>삭제</th>
        <th>대출</th>
    </tr>
    <?php

    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
    $gjc = $_POST["bookquery"];

        $sql="select book_id,name,author,publish,ISBN,introduction,language,price,pubdate,book_info.class_id,class_name,pressmark,state from book_info,class_info where book_info.class_id=class_info.class_id and ( name like '%{$gjc}%' or book_id like '%{$gjc}%')  ;";

    }
    else{
        $sql="select book_id,name,author,publish,ISBN,introduction,language,price,pubdate,book_info.class_id,class_name,pressmark,state from book_info,class_info where book_info.class_id=class_info.class_id ;";
    }


    $res=mysqli_query($dbc,$sql);
    foreach ($res as $row){
        echo "<tr>";
        echo "<td>{$row['book_id']}</td>";
        echo "<td>{$row['name']}</td>";
        echo "<td>{$row['author']}</td>";
        echo "<td>{$row['publish']}</td>";
        echo "<td>{$row['ISBN']}</td>";
        echo "<td>{$row['introduction']}</td>";
        echo "<td>{$row['language']}</td>";
        echo "<td>{$row['price']}</td>";
        echo "<td>{$row['pubdate']}</td>";
        echo "<td>{$row['class_id']}</td>";
        echo "<td>{$row['class_name']}</td>";
        echo "<td>{$row['pressmark']}</td>";
         if($row['state']==1) echo "<td><img src=\"image/bookno.png\"></td>"; else if($row['state']==0) echo "<td><img src=\"image/boed.png\"></td>";else  echo "<td><img src=\"image/nos.png\"></td>";
        echo "<td><a href='admin_book_edit.php?id={$row['book_id']}'><img src='image/xiugai.png'></a></td>";
        echo "<td><a href='admin_book_del.php?id={$row['book_id']}'><img src='image/delete.png'></a></td>";
        if($row['state']==1)echo "<td><a href='admin_book_jiechu.php?id={$row['book_id']}'><img src='image/jieyueguanli.png'></a></td>";
        if($row['state']==0)echo "<td><a href='admin_book_guihuan.php?id={$row['book_id']}'><img src='image/qiandanfanhuan.png'></a></td>";
        echo "</tr>";
    };
    ?>
</table>
</body>
</html>
