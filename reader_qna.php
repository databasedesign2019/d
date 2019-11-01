<?php
session_start();
$userid=$_SESSION['userid'];
include ('mysqli_connect.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>도서관 ||질문하기</title>
    <link rel="stylesheet" href="http://cdn.static.runoob.com/libs/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="http://cdn.static.runoob.com/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="http://cdn.static.runoob.com/libs/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style>
        body{
            width: 100%;
            background-repeat: repeat;
            background-image: url("bg.jpg");
            background-size:cover;
            height:auto;
            color: antiquewhite;
        }

        #query{
            text-align: right;
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
                    <li><a href="../reader_querybook.php">도서 조회</a></li>
                    <li ><a href="reader_borrow.php">마이 대출</a></li>
                    <li><a href="reader_info.php">개인 정보</a></li>
                    <li><a href="reader_repass.php">암호 수정</a></li>
                    <li class="active"><a href="reader_qna.php">문의하기</a></li>
                    <li><a href="reader_guashi.php">분실신고</a></li>
                    <li><a href="index.php">로그아웃</a></li>
                </ul>
            </div>
        </div>
</nav>

<h2 style="text-align: center">모든 질문</h2>
<form  id="query"><input type="button" value="add +" class="btn btn-default" onclick="window.location.href='reader_qna_add.php'"/>
</form>

<table  width=100% class="table">
    <tr>
        <th>번호</th>
        <th>질문자</th>
        <th>제목</th>
        <th>시간</th>
        <th>질문</th>
        <th>대답</th>
        <th>대답자</th>
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
        echo "<td>{$row['qna_id']}</td>";
        echo "<td>{$row['name']}</td>";
        echo "<td>{$row['title']}</td>";
        echo "<td>{$row['push_time']}</td>";
        echo "<td>{$row['question']}</td>";
        echo "<td>{$row['answer']}</td>";
        echo "<td>{$row['admin_name']}</td>";
        echo "</tr>";
    };
    ?>
</table>


</body>
</html>