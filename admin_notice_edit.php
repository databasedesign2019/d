<?php
session_start();
$userid=$_SESSION['userid'];
include ('mysqli_connect.php');
$xgid=$_GET['id'];

$sqlb="select title,time,content,nc_id from notice where noid={$xgid}";
$resb=mysqli_query($dbc,$sqlb);
$resultb=mysqli_fetch_array($resb);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="http://cdn.static.runoob.com/libs/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="http://cdn.static.runoob.com/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="http://cdn.static.runoob.com/libs/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <title>도서관 | | 공지 정보 수정</title>
    <style>
        body{
            width: 100%;
            background: url("bg.jpg") repeat;
            background-size:cover;
            color: black;
        }

    </style>
</head>

<body>
<div class="col-xs-5 col-md-offset-3" style="position: relative;top: 25%">
    <div style="text-align: center">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">공지 정보 수정</h3>
            </div>
            <div class="panel-body">
                <form  action="admin_notice_edit.php?id=<?php echo $xgid; ?>"" method="POST" style="text-align: center" class="bs-example bs-example-form" role="form">
                <div id="login">

                    <div class="input-group"><span class="input-group-addon">제목</span><input name="nname" type="text" value="<?php echo $resultb['title']; ?>" class="form-control"></div><br/>
                    <div class="input-group"><span class="input-group-addon">시간</span><input name="ntime" type="text" value="<?php echo $resultb['time']; ?>" class="form-control"></div><br/>
                    <div class="input-group"><span class="input-group-addon">내용</span><input name="ncontent" type="text"value="<?php echo $resultb['content']; ?>" class="form-control"></div><br/>
                    <div class="input-group"><span class="input-group-addon">구분<select id="box3" select name="nclass"><option value="1">공지</option><option value="2">광고</option><option value="3">이벤트</option><option value="4">뉴스</option></select></span> </div><br/>
                    <label><input type="submit" value="확인" class="btn btn-default"></label>
                    <label><input type="reset" value="리셋" class="btn btn-default"></label>
                </div>
                </form>

            </div>
            </form>
        </div>
    </div>

</div>
<script type="text/javascript">
    $(function(){
        $("#box3").val(<?php echo $resultb['nc_id']; ?>);
    })

</script>
<?php

if ($_SERVER["REQUEST_METHOD"] == "POST")
{

    $boid=$_GET['id'];
    $nname = $_POST["nname"];
    $ntime = $_POST["ntime"];
    $nco = $_POST["ncontent"];
    $nc = $_POST["nclass"];




    $sqla="update notice set title='{$nname}',time='{$ntime}',content='{$nco}',
nc_id='{$nc}' where noid=$boid;";
    $resa=mysqli_query($dbc,$sqla);


    if($resa==1)
    {

        echo "<script>alert('수정 성공！')</script>";
        echo "<script>window.location.href='admin_notice.php'</script>";

    }
    else
    {
        echo "<script>alert('수정 실패! 다시 입력해주세요!');</script>";

    }

}


?>
</body>
</html>
