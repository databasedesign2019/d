<?php
session_start();
if(isset($_SESSION['userid']))
{
    unset($_SESSION['userid']);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>도서관 || 로그인</title>
    <link rel="stylesheet" href="http://cdn.static.runoob.com/libs/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="http://cdn.static.runoob.com/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="http://cdn.static.runoob.com/libs/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style>

        body{
            width: 100%;
            height: 100%;
            background: url("bg.jpg") repeat;
            background-size:cover;
            color: antiquewhite;
        }

    </style>

</head>
<body>
<div class="col-xs-5 col-md-offset-3" style="position: relative;top: 25%;">
    <div style="text-align: center">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">로그인</h3>
        </div>
        <div class="panel-body">
            <form  action="login_check.php" method="POST" class="bs-example bs-example-form" role="form">
                <div id="login">
                    <div class="input-group"><span class="input-group-addon"><img src="image/yonghu.png">  아이디</span><input  name="account" type="text" placeholder="사용자 아이디\아이디  입력" class="form-control"></div><br><br>
                    <div class="input-group"><span class="input-group-addon"><img src="image/mima.png">  비밀번호</span><input  name="pass" type="password" placeholder="비밀번호 입력" class="form-control"></div><br><br><br>
                    <input type="submit" value="로그인" class="btn btn-default">
                    <input type="reset" value="리셋" class="btn btn-default">
        </div>
    </div>
</div>
        </div>
    </form>
</div>
</body>
</html>