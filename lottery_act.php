<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION["userid"])) {
    $userid = "";
    $Attendance_total=0;
    $lottery=0;

    $userid = $_SESSION["userid"];
        //로그인 되어 있으면 가서 다른 변수 정보 받아오기.

    $con = mysqli_connect("localhost", "user1", "12345", "sample");
    $sql = "select * from members where id = '".$userid."';"; 
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($result);
    $lottery=$row['lottery'];

    $Attendance_total=$row['Attendance_total'];
    $attendance=$row['attendance'];

    if($lottery==null){
        $lottery=0;
    }
    if($Attendance_total==null){
        $Attendance_total=0;
    }
    //버튼 값 가져오기
    $click=$_GET["click"];

    //출석
    if($click == 1){
        if($attendance==date("Y-m-d", time())){
            
            $Attendance_total=$Attendance_total+1;
            $sql2 = "update members set attendance=".date("Y-m-d", time()).", Attendance_total=".$Attendance_total." where id = $userid";
            mysqli_query($con,$sql2);
            echo '<script type="text/javascript">alert("출석 되었습니다.");</script>';
            echo '<script type="text/javascript">window.location.href = "lottery.php";</script>';
        }

        else {
            
            echo '<script type="text/javascript">alert("이미 출석 되었습니다.");</script>';
            echo '<script type="text/javascript">window.location.href = "lottery.php";</script>';
        }
        
    }

    //응모
    else{
        
        $lottery=$lottery+1;
        $sql2 = "update members set lottery=".$lottery." where id = $userid";
        mysqli_query($con,$sql2);
        echo '<script type="text/javascript">alert("응모 되었습니다.");</script>';
        echo '<script type="text/javascript">window.location.href = "lottery.php";</script>';
        
    }

}  

else {
    echo '<script type="text/javascript">alert("로그인 해주세요!");</script>';
    echo 'window.location.href = "lottery.php";</script>';
}




?>