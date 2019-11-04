<?php
session_start();
$userid=$_SESSION['userid'];
include ('mysqli_connect.php');
$xgid=$_GET['id'];
$sqlb="select qna_id,title,push_time,question,answer,name,admin_name  from  reader_info,qna,admin where qna_id={$xgid} and qna.reader_id=reader_info.reader_id and qna.admin_id=admin.admin_id ";
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
    <title>질문|<?php echo $resultb['title']; ?></title>
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
<?php if ($_SERVER["REQUEST_METHOD"] == "POST")
{
$sql="select qna_id,title,push_time,question,answer,name,admin_name  from  reader_info,qna,admin where qna.reader_id=reader_info.reader_id and qna.admin_id=admin.admin_id ;";
}
else{
$sql=" ;";
}
$res=mysqli_query($dbc,$sql);
?>

<div class="col-xs-5 col-md-offset-3" style="position: relative;top: 25%">
    <div style="text-align: left">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title"style="text-align:center">Q&A상황</h3>
            </div>
            <div class="panel-body">
                <h3 style="text-align:center"><?php echo $resultb['title']; ?></h3>
                <h5 style="text-align:center">시간:<?php echo $resultb['push_time'];?> |질문자:<?php echo $resultb["name"];?>  </h5>
              <h3 >Question</h3>
        <h4 ><br><?php echo $resultb['question']; ?></h4>
                <h3>Answer | 대답자:<?php echo $resultb["admin_name"];?> </h3>
                <h4><br><?php echo $resultb['answer']; ?></h4>
                <form  action="admin_qna_read.php?id=<?php echo $xgid; ?>"" method="POST" style="text-align: center" class="bs-example bs-example-form" role="form">
                <div class="input-group"><span class="input-group-addon">대답하는 관리자</span><input name="admin" type="text" value="<?php echo $userid;?>" class="form-control" readonly="true" /></div><br/>
                <div class="input-group"><span class="input-group-addon">대답내용</span><input name="nanswer" type="text" value="<?php echo  $resultb['answer'];?>" class="form-control"></div><br/>
                <label><input type="submit" value="확인" class="btn btn-default"></label>
                <label><input type="reset" value="리셋" class="btn btn-default"></label>
            </form>

                <div style="text-align:center">  <a href="javascript:window.opener=null;window.open('','_self');window.history.go(-1);"><img src="image/shangyiye.png">지난 페이지</a>|<a href='admin_qna_del.php?id=<?php echo $resultb['qna_id'];?>'><img src="image/delete.png">삭제</a>|<a href='admin_qna_edit.php?id=<?php echo $resultb['qna_id'];?>'><img src="image/xiugai.png">수정</a>
              </div>
                <?php

                if ($_SERVER["REQUEST_METHOD"] == "POST")
                {

                    $nadmin = $_POST["admin"];
                    $nanswer = $_POST["nanswer"];
                    $sqld="update qna set admin_id='{$nadmin}',answer='{$nanswer}' where qna_id=$xgid;";
                    $resd=mysqli_query($dbc,$sqld);


                    if($resd==1)
                    {

                        echo "<script>alert('대답 성공！')</script>";
                        echo "<script>window.location.href='admin_qna.php'</script>";

                    }
                    else
                    {
                        echo "<script>alert('대답 실패! 다시 력해주세요!');</script>";

                    }}?>



            </div>

        </div>
    </div>

</div>

</body>
</html>
