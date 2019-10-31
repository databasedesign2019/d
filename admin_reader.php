<?php
session_start();
$userid=$_SESSION['userid'];
include ('mysqli_connect.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>도서관 || 사용자관리</title>
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
                <li class="dropdown"><a href="admin_index.php">홈페이지</a></li>
                <li class="dropdown">
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
<h1 style="text-align: center"><strong>모든 사용자</strong></h1>
<form  id="query" action="admin_reader.php" method="POST">
    <div id="query">
        <label ><input  name="readerquery" type="text" placeholder="사용자 이름 또는 사용자 번호 입력" class="form-control"></label>
        <input type="submit" value="조회" class="btn btn-default">
    </div>
</form>
<table  width='100%' class="table table-hover">
    <tr>
        <th>사용자번호</th>
        <th>성명</th>
        <th>성별</th>
        <th>생일</th>
        <th>주소</th>
        <th>휴데전화</th>
        <th>이메일</th>
        <th>사용자 상태</th>
        <th>조작</th>
        <th>조작</th>
    </tr>
    <?php



    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $gjc = $_POST["readerquery"];

        $sql="select reader_info.reader_id, reader_info.name,sex,birth,address,telcode,card_state,email from reader_info,reader_card where reader_info.reader_id=reader_card.reader_id and (name like '%{$gjc}%' or reader_id like '%{$gjc}%') ;";

    }
    else{
        $sql="select reader_info.reader_id, reader_info.name, sex, birth, address, telcode, card_state,email
from reader_info, reader_card where reader_info.reader_id = reader_card.reader_id";
    }


    $res=mysqli_query($dbc,$sql);
    foreach ($res as $row){
        echo "<tr>";
        echo "<td>{$row['reader_id']}</td>";
        echo "<td>{$row['name']}</td>";
        echo "<td>{$row['sex']}</td>";
        echo "<td>{$row['birth']}</td>";
        echo "<td>{$row['address']}</td>";
        echo "<td>{$row['telcode']}</td>";
        echo "<td>{$row['email']}</td>";
        if($row['card_state']==1) echo "<td>정상</td>"; else echo "<td>분실중</td>";
        echo "<td><a href='admin_reader_edit.php?id={$row['reader_id']}'>수정</a></td>";
        echo "<td><a href='admin_reader_del.php?id={$row['reader_id']}'>삭제</a></td>";
        echo "</tr>";
    };
    ?>
</table>
</body>
</html>