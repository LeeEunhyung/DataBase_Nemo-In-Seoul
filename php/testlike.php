<?
include './dbconn.php';
mysqli_set_charset($conn, 'utf8');
session_start();
$_SESSION['cnt']=1;

$_SESSION['islike'] = $_POST['likecheck'];

if ($_POST['likecheck']==1) {
    $_SESSION['likes'] = (int)$_SESSION['likes']+1;

    $udt_sql = "update place set likes='".$_SESSION['likes']."' where place_name='".$_SESSION['place']."'";
    $udt_result = mysqli_query($conn, $udt_sql);

    $res_sql = "update member set point=point+5 where member_id=(select member_id from place where place_name='".$_SESSION['place']."')";
    $res_result = mysqli_query($conn, $res_sql);

    $lev_sql = "select member_id, level, point from member where member_id=(select member_id from place where place_name='".$_SESSION['place']."')";
    $lev_result = mysqli_query($conn, $lev_sql);
    $row = mysqli_fetch_row($lev_result);

    echo $row[0];

    $_SESSION['islike'] = 0;
    $_SESSION['likelabel'] = '♥ click like';
}
else if ($_POST['likecheck']==0) {
    $_SESSION['likes'] = (int)$_SESSION['likes']-1;

    $udt_sql = "update place set likes='".$_SESSION['likes']."' where place_name='".$_SESSION['place']."'";
    $udt_result = mysqli_query($conn, $udt_sql);

    if ($_SESSION['point']>=5) {
        $res_sql = "update member set point=point-5 where member_id=(select member_id from place where place_name='".$_SESSION['place']."')";
        $res_result = mysqli_query($conn, $res_sql);
    }

    $_SESSION['islike'] = 1;
    $_SESSION['likelabel'] = '♡ click like';
}

if ($row[2]<50) {
    $lev2_sql = "update member set level='seed' where member_id='$row[0]'";
    $lev2_result = mysqli_query($conn, $lev2_sql);
}
else if (50<=$row[2] && $row[2]<150) {
    $lev2_sql = "update member set level='prout' where member_id='$row[0]'";
    $lev2_result = mysqli_query($conn, $lev2_sql);
}
else if (150<=$row[2] && $row[2]<250) {
    $lev2_sql = "update member set level='tree' where member_id='$row[0]'";
    $lev2_result = mysqli_query($conn, $lev2_sql);
}
else if (250<=$row[2] && $row[2]<400) {
    $lev2_sql = "update member set level='flower' where member_id='$row[0]'";
    $lev2_result = mysqli_query($conn, $lev2_sql);
}
else if ($row[2]>=400) {
    $lev2_sql = "update member set level='fruit' where member_id='$row[0]'";
    $lev2_result = mysqli_query($conn, $lev2_sql);
}

?>
<script>
    location.href="./detail_placephp.php";
</script>