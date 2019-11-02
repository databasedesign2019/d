<?php
session_start();
$userid=$_SESSION['userid'];
include ('mysqli_connect.php');

$sql="select name from reader_card where reader_id={$userid}";
$res=mysqli_query($dbc,$sql);
$result=mysqli_fetch_array($res);
date_default_timezone_set("KR");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>마이 도서관</title>
    <link rel="stylesheet" href="http://cdn.static.runoob.com/libs/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="http://cdn.static.runoob.com/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="http://cdn.static.runoob.com/libs/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style>
        a:link{text-decoration: none;color: gray}
        a:active{text-decoration:blink}
        a:hover{text-decoration:underline;color: red}
        a:visited{text-decoration: none;color: yellow}
    body{
            width: 100%;
            overflow: hidden;
            background-repeat: repeat;
            background-image: url("bg.jpg");
            background-size:cover;
            color: antiquewhite;
        }
        #gonggao{
            position: absolute;
            left: 50%;
            top: 50%;
        }
    </style>
</head>
<body>
<body>
<nav class="navbar navbar-default navbar-static-top" role="navigation">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">마이 도서관</a>
        </div>
        <div>
            <ul class="nav navbar-nav">
                <li class="active"><a href="reader_index.php">홈페이지</a></li>
                <li><a href="../reader_querybook.php">도서 조회</a></li>
                <li ><a href="reader_borrow.php">마이 대출</a></li>
                <li><a href="reader_info.php">개인 정보</a></li>
                <li><a href="reader_repass.php">암호 수정</a></li>
                <li><a href="reader_qna.php">문의하기</a></li>
                <li><a href="reader_guashi.php">분실신고</a></li>
                <li><a href="index.php">로그아웃</a></li>
            </ul>
        </div>
    </div>
</nav>

</h4>

    <br/><br/><h3 style="text-align: center"><?php echo $result['name'];  ?> 님,안녕하십니까?</h3><br/>
    <h4 style="text-align: center"><?php
        $sqla="select count(*) a from lend_list where reader_id={$userid} and back_date is NULL;";

        $resa=mysqli_query($dbc,$sqla);
        $resulta=mysqli_fetch_array($resa);
        echo "당신 지금 까지 빌려한 책은 {$resulta['a']}권입니다";
        ?>
    </h4>
    <h4 style="text-align: center">
        <?php
        $sqlb="select DATE_ADD(lend_date,INTERVAL 1 MONTH) AS yhrq from lend_list where reader_id={$userid} and back_date is NULL;";
        $counta=0;
        $resb=mysqli_query($dbc,$sqlb);

        foreach ($resb as $row){
            if(strtotime(date("y-m-d"))>strtotime($row['yhrq'])) $counta++;
        };

        if($counta==0) echo "지금까지 초기한 미반납 책은 없다";
        else echo "{$counta}권 책은 초기했습니다.실시간 반납하시오";


        ?></h4>
        <hr>
        <h3 style="text-align: center">공지 상황</h3>
    <table  width='80%' class="table">

        <tr>
            <th>번호</th>
            <th>제목</th>
            <th>시간</th>
            <th>내용</th>
            <th>구분</th>
        </tr>
        <?php

        if ($_SERVER["REQUEST_METHOD"] == "POST")
        {
            $sql="select noid,title,time,content,nc_id,nc_name from notice,notice_class where notice.nc_id=notice_class.nc_id  ;";
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
            echo "<td>{$row['nc_name']}</td>";
            echo "</tr>";
        };
        ?>


    </table>

</body>
</body>
</body>
</html>
