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
    <title>마이 도서관 || 마이 대출</title>
    <link rel="stylesheet" href="http://cdn.static.runoob.com/libs/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="http://cdn.static.runoob.com/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="http://cdn.static.runoob.com/libs/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style>
        body{
            width: 100%;
            overflow: hidden;
            background-repeat: repeat;
            background-image: url("bg.jpg");
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
                <li class="active"><a href="reader_borrow.php">마이 대출</a></li>
                <li><a href="reader_info.php">개인 정보</a></li>
                <li><a href="reader_repass.php">암호 수정</a></li>
                <li><a href="reader_guashi.php">분실신고</a></li>
                <li><a href="index.php">로그아웃</a></li>
            </ul>
        </div>
    </div>
</nav>

<h3 style="text-align: center"><?php echo $result['name'];  ?>님，안녕하십니까?</h3><br/>
<h4 style="text-align: center">당신이 이미 빌려 보신 책의 목록은 다음과 같습니다.：</h4>

<table  width='100%' class="table">
    <tr>
        <th>대출번호</th>
        <th>도서 번호</th>
        <th>도서 이름</th>
        <th>대출일자</th>
        <th>반납일자</th>
    </tr>
    <?php



    $sqla="select sernum,book_info.book_id,book_info.name,lend_date,back_date from lend_list,book_info where reader_id={$userid} and lend_list.book_id=book_info.book_id;";

    $resa=mysqli_query($dbc,$sqla);
    foreach ($resa as $row){
        echo "<tr>";
        echo "<td>{$row['sernum']}</td>";
        echo "<td>{$row['book_id']}</td>";
        echo "<td>{$row['name']}</td>";
        echo "<td>{$row['lend_date']}</td>";
        echo "<td>{$row['back_date']}</td>";
        echo "</tr>";
    };
    ?>
</table>
</body>
</html>