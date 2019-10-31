<?php
session_start();
$userid=$_SESSION['userid'];
include ('mysqli_connect.php');


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="http://cdn.static.runoob.com/libs/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="http://cdn.static.runoob.com/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="http://cdn.static.runoob.com/libs/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <title>도서관 || 공지 추가</title>
</head>
<style>
    body{
        width: 100%;
        background-repeat: repeat;
        background-image: url("bg.jpg");
        background-size:cover;
        color: antiquewhite;
    }

</style>
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
                        <li><a href="admin_book_add.php">서적 증가</a></li>
                    </ul>
                <li class="active" class="dropdown" >
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">공지 관리<b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="admin_notice.php">모든 공지</a></li>
                        <li><a href="admin_notice_add.php">공지 추가</a></li>
                    </ul>
                </li>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">사용자 관리<b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="admin_reader.php">모든 사용자</a></li>
                        <li><a href="admin_reader_add.php">사용자 증가</a></li>
                    </ul>
                </li>
                <li><a href="admin_borrow_info.php">대출관리</a></li>
                <li><a href="admin_repass.php">암호 수정</a></li>
                <li><a href="index.php">로그아웃</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="col-xs-5 col-md-offset-3" style="position: relative;top: 25%">
    <div style="text-align: center">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">공지 증가</h3>
            </div>
            <div class="panel-body">
                        <form  action="admin_notice_add.php" method="POST" style="text-align: center" class="bs-example bs-example-form" role="form">
                            <div id="login">
                                <div class="input-group"><span class="input-group-addon">제목</span><input name="nname" type="text" placeholder="제목 입력하시오" class="form-control"></div><br/>
                                <div class="input-group"><span class="input-group-addon">시간</span><input name="ntime" type="text" value="<?php echo $showtime=date("Y-m-d H:i:s");?>" class="form-control"></div><br/>
                                <div class="input-group"><span class="input-group-addon">내용</span><input name="ncontent" type="text" placeholder="내용 입력하시오" class="form-control"></div><br/>
                                <div class="input-group"><span class="input-group-addon">구분<select id="box" select name="nclass"><option value="1">공지</option><option value="2">광고</option><option value="3">추천</option><option value="4">뉴스</option></select></span> </div><br/>

                                <label><input type="submit" value="추가" class="btn btn-default"></label>
                                <label><input type="reset" value="리셋" class="btn btn-default"></label>
                    </div>
                        </form>
            </div>
        </div>

</div>
<?php

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    $nnam = $_POST["nname"];
    $nt = $_POST["ntime"];
    $nco = $_POST["ncontent"];
    $nc = $_POST["nclass"];




    $sqla="insert into notice VALUES (NULL ,'{$nnam}','{$nt}','{$nco}',{$nc} )";
    $resa=mysqli_query($dbc,$sqla);


    if($resa==1)
    {

        echo "<script>alert('추가 성공！')</script>";
        echo "<script>window.location.href='admin_notice.php'</script>";

    }
    else
    {
        echo "<script>alert('추가 실패! 다시 입력해주세요！');</script>";

    }

}

?>
</body>
</html>
