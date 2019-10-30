<?php
session_start();
include ('mysqli_connect.php');
$userid=$_SESSION['userid'];
$sql="select name from reader_card where reader_id={$userid}";
$res=mysqli_query($dbc,$sql);
$result=mysqli_fetch_array($res);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>마이 도서관 || 암호수정</title>
    <link rel="stylesheet" href="http://cdn.static.runoob.com/libs/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="http://cdn.static.runoob.com/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="http://cdn.static.runoob.com/libs/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style>
        body{
            width: 100%;
            overflow: hidden;
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
                <li ><a href="reader_index.php">홈페이지</a></li>
                <li><a href="reader_querybook.php">도서 조회</a></li>
                <li ><a href="reader_borrow.php">마이 대출</a></li>
                <li><a href="reader_info.php">개인 정보</a></li>
                <li class="active"><a href="reader_repass.php">암호 수정</a></li>
                <li ><a href="reader_guashi.php">분실신고</a></li>
                <li><a href="index.php">로그아웃</a></li>
            </ul>
        </div>
    </div>
</nav>
<h3 style="text-align: center"><?php echo $result['name'];  ?>님，안녕하시닙까?</h3><br/>
<div class="col-xs-5 col-md-offset-3" style="position: relative;top: 25%">
    <div style=" text-align: center ">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">비밀번호 수정</h3>
            </div>
            <div class="panel-body">
<form action="reader_repass.php" method="post"  style="text-align: center">
    <label><br/><input type="password" name="pass1" placeholder="뉴 비미번호 입력하시오" class="form-control"></label><br/><br/><br/>
    <label><br/><input type="password" name="pass2" placeholder="뉴 비밀번호 확인 하시오" class="form-control"></label><br/><br/>
    <input type="submit" value="수정" class="btn btn-default">
    <input type="reset" value="리셋"  class="btn btn-default">
</form>
            </div>
        </div>
    </div>
</div>
<?php

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    $passa = $_POST["pass1"];
    $passb = $_POST["pass2"];
if($passa==$passb){
    $sql="update reader_card set passwd='{$passa}' where reader_id={$userid}";
    $res=mysqli_query($dbc,$sql);
    if($res==1)
    {
        echo "<script>alert('수정 성공！다시 로그인하시오！！')</script>";
        echo "<script>window.location.href='index.php'</script>";
    }

}
else{
    echo "<script>alert('두번 입력한 비밀번호 다른다，다시 입력하시오！')</script>";

}

}


?>
</body>
</html>