<?php
session_start();
$userid=$_SESSION['userid'];
include ('mysqli_connect.php');
$xgid=$_GET['id'];
$sqlb="select noid,title,time,content,notice.nc_id,nc_name  from  notice,notice_class where noid={$xgid} and notice.nc_id=notice_class.nc_id";
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
    <title>공지|<?php echo $resultb['title']; ?></title>
    <style>
        body{
            width: 100%;
            overflow: hidden;
            background: url("bg.jpg") repeat;
            background-size:cover;
            color: black;
        }

    </style>
</head>

<body>
<?php if ($_SERVER["REQUEST_METHOD"] == "POST")
{
$sql="select noid,title,time,content,nc_id,nc_name from notice,notice_class where notice.nc_id=notice_class.nc_id  ;";
}
else{
$sql=" ;";
}
$res=mysqli_query($dbc,$sql);
?>

<div class="col-xs-5 col-md-offset-3" style="position: relative;top: 25%">
    <div style="text-align: center">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">공지상황</h3>
            </div>
            <div class="panel-body">
                <h3><?php echo $resultb['title']; ?></h3>
                <h5>시간:<?php echo $resultb['time'];?>  |  분류:<?php echo $resultb['nc_name'];?></h5>
        <h4><?php echo $resultb['content']; ?></h4>
                <a href="javascript:window.opener=null;window.open('','_self');window.history.go(-1);"><img src="image/shangyiye.png">지난 페이지</a>|<a href='admin_notice_del.php?id=<?php echo $resultb['noid'];?>'><img src="image/delete.png">삭제</a>|<a href='admin_notice_edit.php?id=<?php echo $resultb['noid'];?>'><img src="image/xiugai.png">수정</a>
            </div>
    </form>

            </div>
            </form>
        </div>
    </div>

</div>

</body>
</html>
