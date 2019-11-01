<?php
session_start();
$userid=$_SESSION['userid'];
include ('mysqli_connect.php');
$readerid=$_GET['id']

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="http://cdn.static.runoob.com/libs/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="http://cdn.static.runoob.com/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="http://cdn.static.runoob.com/libs/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <title>도서관 || 질문 추가</title>
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
<div class="col-xs-5 col-md-offset-3" style="position: relative;top: 25%">
    <div style="text-align: center">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">질문 증가</h3>
            </div>
            <div class="panel-body">
                        <form  action="reader_qna_add.php" method="POST" style="text-align: center" class="bs-example bs-example-form" role="form">
                            <div id="login">
                                <div class="input-group"><span class="input-group-addon">제목</span><input name="ntitle" type="text" placeholder="제목 입력하시오" class="form-control"></div><br/>
                                <div class="input-group"><span class="input-group-addon">user</span><input name="nid" type="text" value="<?php echo $userid;?>" class="form-control" readonly="true" /></div><br/>
                                <div class="input-group"><span class="input-group-addon">시간</span><input name="ntime" type="text" value="<?php echo $showtime=date("Y-m-d H:i:s");?> " class="form-control"readonly="true"></div><br/>
                                <div class="input-group"><span class="input-group-addon">문의내용</span><input name="ncontent" type="text" placeholder="내용 입력하시오" class="form-control"></div><br/>

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
    $nti = $_POST["ntitle"];
    $nt = $_POST["ntime"];
    $nco = $_POST["ncontent"];
    $isd=$_POST["nid"];
    $nanswer="아직 대답이 없다";
    $nadmin="0001";


    $sqla="insert into qna VALUES (NULL ,'{$nti}','{$nt}','{$nco}','{$nanswer}',{$isd},'{$nadmin}' )";
    $resa=mysqli_query($dbc,$sqla);


    if($resa==1)
    {

        echo "<script>alert('추가 성공！')</script>";
        echo "<script>window.location.href='reader_qna.php'</script>";

    }
    else
    {
        echo "<script>alert('추가 실패! 다시 입력해주세요！');</script>";

    }

}

?>
</body>
</html>
