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
    <title>마이 도서관 || 도서 조회</title>
    <link rel="stylesheet" href="http://cdn.static.runoob.com/libs/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="http://cdn.static.runoob.com/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="http://cdn.static.runoob.com/libs/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style>
        #resbook{
            top:50%;

        }
        #query{

            text-align: center;
        }
        body{
            width: 100%;

            background: url("bg.jpg") repeat;
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
                <li><a href="reader_index.php">홈페이지</a></li>
                <li class="active"><a href="reader_querybook.php">도서 조회</a></li>
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
<h3 style="text-align: center"><?php echo $result['name'];  ?>님,안녕하십니까?</h3><br/>
<h4 style="text-align: center">도서 조회：</h4>


<form  action="reader_querybook.php" method="POST">
    <div id="query">
        <label ><input  name="bookquery" type="text" placeholder="도서 이름/번호 입력하시오" class="form-control"></label>
        <input type="submit" value="조회" class="btn btn-default">
    </div>
</form>
<?php

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    $gjc = $_POST["bookquery"];
    if($gjc=="") echo "<script>alert('조회 단어 공백을 두지 마십시오 ！')</script>";
    else{
        $sqla="select book_id,name,author,publish,ISBN,introduction,language,price,pubdate,book_info.class_id,class_name,pressmark,state from book_info,class_info where book_info.class_id=class_info.class_id and ( name like '%{$gjc}%' or book_id like '%{$gjc}%')  ;";

        $resa=mysqli_query($dbc,$sqla);
        $jgs=mysqli_num_rows($resa);

        if($jgs==0)  echo "<script>alert('도서관 내에 이 책이 잠시 없다.！')</script>";
        else{
            echo "<table   id='resbook' class='table'>
    <tr>
           <th>번호</th>
        <th>제목</th>
        <th>저자</th>
        <th>출판사</th>
        <th>ISBN</th>
        <th>소개</th>
        <th>언어</th>
        <th>값격</th>
        <th>출판날짜</th>
        <th>구분</th>
        <th> 책장호</th>
        <th> 상태</th>
    </tr>";
            foreach ($resa as $row){
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
                echo "<td>{$row['class_name']}</td>";
                echo "<td>{$row['pressmark']}</td>";
                if($row['state']==1) echo "<td><img src=\"image/bookno.png\"></td>"; else if($row['state']==0) echo "<td><img src=\"image/boed.png\"></td>";else  echo "<td><img src=\"image/nos.png\"></td>";
                echo "</tr>";
            };
        };



        echo "</table>";



    }


}
?>
</body>
</html>