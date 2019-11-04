<?php
session_start();
$userid=$_SESSION['userid'];
include ('mysqli_connect.php');
$xgid=$_GET['id'];
$sqlb="select qna_id,title,push_time,question,answer,name,admin_name  from  reader_info,qna,admin where qna_id={$xgid} and qna.reader_id=reader_info.reader_id and qna.admin_id=admin.admin_id ;";
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
            background: url("bg.jpg") repeat;
            background-size:cover;
            color: black;
        }

    </style>
</head>
<nav class="navbar navbar-default navbar-static-top" role="navigation">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">마이 도서관</a>
        </div>
        <div>
            <ul class="nav navbar-nav">
                <li class="active"><a href="reader_index.php">홈페이지</a></li>
                <li><a href="reader_querybook.php">도서 조회</a></li>
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
<body>
<?php if ($_SERVER["REQUEST_METHOD"] == "POST")
{

$sql="select qna_id,title,push_time,question,answer,name,admin_name  from  reader_info,qna,admin where qna_id={$_GET['id']} and qna.reader_id=reader_info.reader_id and qna.admin_id=admin.admin_id ;";
}
else{
$sql=" ;";
}
$res=mysqli_query($dbc,$sql);
?>

<div class="col-xs-5 col-md-offset-3" style="position: relative;top: 25%">

        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title" style="text-align:center">Q&A상황</h3>
            </div>
            <div class="panel-body">
                <h3 style="text-align:center"><?php echo $resultb['title']; ?></h3>
                <h5 style="text-align:center">시간:<?php echo $resultb['push_time'];?> |질문자:<?php echo $resultb["name"];?>  </h5>
                <h3 >Question</h3>
                <h4 > <br><?php echo $resultb['question']; ?></h4>
                <h3>Answer | 대답자:<?php echo $resultb["admin_name"];?> </h3>
                <h4> <br><?php echo $resultb['answer']; ?></h4>

              <div  style="text-align:center">  <a href="javascript:window.opener=null;window.open('','_self');window.history.go(-1);"><img src="image/shangyiye.png">지난 페이지</a>

              </div>
            </div>
        </div>
    </form>

            </div>






</body>
</html>
