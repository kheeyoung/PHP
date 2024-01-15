<!DOCTYPE html> 
<html>
<head>
<meta charset="utf-8">
<title>PHP 프로그래밍 입문</title>
<link rel="stylesheet" type="text/css" href="./css/common.css">
<link rel="stylesheet" type="text/css" href="./css/main.css">
</head>
<body>

<header>
    <?php include "header.php";?>
</header>

<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
    if (isset($_SESSION["userid"])) {
        $userid = $_SESSION["userid"];
        //로그인 되어 있으면 가서 다른 행 정보 받아오기.

        $con = mysqli_connect("localhost", "user1", "12345", "sample");
        $sql = "select * from members where id = '".$userid."';"; 
        $result = mysqli_query($con, $sql);
        $row = mysqli_fetch_array($result);
        $lottery=$row['lottery'];
        echo "로그인 됨!";

        $Attendance_total=$row['Attendance_total'];
        $attendance=$row['attendance'];
    
    }
    else {
        echo "로그인 안됨";
        $userid = "";
        $Attendance_total=0;
        $lottery=0;
    }
    if (isset($_SESSION["username"])) $username = $_SESSION["username"];
    else $username = "";
    if (isset($_SESSION["userlevel"])) $userlevel = $_SESSION["userlevel"];
    else $userlevel = "";
    if (isset($_SESSION["userpoint"])) $userpoint = $_SESSION["userpoint"];
    else $userpoint = "";

    
    if($lottery==null){
        $lottery=0;
    }
    if($Attendance_total==null){
        $Attendance_total=0;
    }
    
?>

<section> 


<div id="main_img_bar">
    <img src="./img/main_img.png"> 
</div> 

<div style=" text-align: center;">
</br>
<p style="text-align:center;"><strong>출석체크</strong></p>
<p style="text-align:right;">누적 출석 일 수: <?php echo "$Attendance_total";?></p>
<p style="text-align:center;"><?php echo "$username";?>님, 어서 오세요!</p>

<div id="att_form">  
        <form  name="att_form" method="get" action="lottery_act.php?click=1"> 
            <div id="att_btn">    
                <a href="lottery_act.php?click=1"><img src="./img/button_save.gif"></a>
            </div>
        </form>
</div> 


</br></br>

	---------------------------------------------------------------------------------------------------------

<p style="text-align:center;"><strong>이벤트 안내</strong></p>
<p style="text-align:right;">누적 응모 횟수: <?php echo "$lottery";?></p>


<div id="lot_form">  
        <form  name="lot_form" method="get" action="lottery_act.php?click=2"> 
            <div id="lot_btn">    
                <a href="lottery_act.php?click=2"><img src="./img/b_vote.gif"></a>
            </div>
        </form>
</div> 

</br></br>


</div>
<footer>  
    <?php include "footer.php";?>
</footer> 
</body>
</html>