<?php
session_start();
$userid=$_SESSION['userid'];

include ('mysqli_connect.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>도서관||홈페이지</title>
    <link rel="stylesheet" href="http://cdn.static.runoob.com/libs/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="http://cdn.static.runoob.com/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="http://cdn.static.runoob.com/libs/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style>
        body{
            width: 100%;
            background: url("bg.jpg") repeat;
            background-size:cover;
            color: antiquewhite;
        }
		a{color:#ffffff}
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
                <li class="active"><a href="admin_index.php">홈페이지</a></li>
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


<h3 style="text-align: center"><?php echo $userid;  ?> 호 관리자님，안녕하시니까?</h3><br/><br/><br/>
<h4 style="text-align: center"><?php
    $sql="select count(*) a from book_info;";
    $res=mysqli_query($dbc,$sql);
    $result=mysqli_fetch_array($res);
    echo "도서관은 현재 도서를{$result['a']}권 보유";
    ?>
</h4>

<h4 style="text-align: center">
    <?php
    $sqla="select count(*) b from reader_card;";
    $resa=mysqli_query($dbc,$sqla);
    $resulta=mysqli_fetch_array($resa);
    echo "사용자는 {$resulta['b']}명 보유";
    ?>
</h4>
<h4 style="text-align: center"><?php
    $sql="select count(*) a from notice;";
    $res=mysqli_query($dbc,$sql);
    $result=mysqli_fetch_array($res);
    echo "발표된 공지상황은 {$result['a']}개 보유";
    ?>
</h4>
<h4 style="text-align: center"><?php
    $sql="select count(*) a from qna;";
    $res=mysqli_query($dbc,$sql);
    $result=mysqli_fetch_array($res);
    echo "지금 문의는 {$result['a']}개 보유";
    ?>
</h4>
<h5 style="text-align: center;color: brown"><?php
$sql="select count(*) b from qna where admin_id=0001;";
$res=mysqli_query($dbc,$sql);
$result=mysqli_fetch_array($res);
echo "미처리 문의는 {$result['b']}개 보유"; ?></h5>
<h4>오늘 생일 사용자</h4>
<table  width='100%' class="table">
 <div style="text-align: center">
    <tr>
        <th>사용자 번호</th>
        <th>성함</th>
        <th>생일</th>
        <th>이메일</th>

    </tr>
    <?php

        $sql="select reader_id,name,birth,email from reader_info where MONTH(birth) = MONTH(NOW()) and DAY(birth) = DAY(NOW());";
    

    $res=mysqli_query($dbc,$sql);
    foreach ($res as $row){
        echo "<tr>";
        echo "<td>{$row['reader_id']}</td>";
        echo "<td>{$row['name']}</td>";
        echo "<td>{$row['birth']}</td>";
        echo "<td><a href=\"mailto:{$row['email']}\">{$row['email']}</a></td>";
        echo "</tr>";
    };
    ?>
</table>
</div>
<div id="bot" style="text-align: center;font-size:15px;position:absolute;left:32%;bottom:30px "><i style="text-align: center">2019-2데이타베이스 20161795 GUJIAKAI|20174950 WENJIALI|20170855 CHENWENXI</i></div>


</body>
</html>
