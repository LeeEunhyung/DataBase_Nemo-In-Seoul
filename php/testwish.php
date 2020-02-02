<?
include './dbconn.php';
mysqli_set_charset($conn, 'utf8');
session_start();

$_SESSION['cnt2']=1;
$_SESSION['iswish'] = $_POST['wishcheck'];


$chk_sql = "select * from wishlist where place_name='".$_SESSION['place']."' and member_id='".$_SESSION['member_id']."'";
$chk_result = mysqli_query($conn, $chk_sql);
$row = mysqli_fetch_row($chk_result);

if ($_POST['wishcheck']==1) {

    if($row[2]==$_SESSION['place'] && $row[1]==$_SESSION['member_id']) {
        header("location:./detail_placephp.php");
        return;
    }
    $ins_sql = "insert into wishlist(member_id, place_name) values('".$_SESSION['member_id']."','".$_SESSION['place']."')";
    $ins_result = mysqli_query($conn, $ins_sql);

    $_SESSION['iswish'] = 0;
    $_SESSION['wishlabel'] = '- delete wishlist';

    header("location:./detail_placephp.php");
}
else if ($_POST['wishcheck']==0) {

    $del_sql = "delete from wishlist where member_id='".$_SESSION['member_id']."' and place_name='".$_SESSION['place']."'";
    $del_result = mysqli_query($conn, $del_sql);

    if ($del_result=="") {
        header("location:./detail_placephp.php");
        return;
    }

    $num_sql = "alter table wishlist AUTO_INCREMENT = 1";
    $num_result = mysqli_query($conn, $num_sql);

    $num_sql = "set @count=0";
    $num_result = mysqli_query($conn, $num_sql);

    $num_sql = "update wishlist SET num = @COUNT:=@COUNT+1";
    $num_result = mysqli_query($conn, $num_sql);

    $_SESSION['iswish'] = 1;
    $_SESSION['wishlabel'] = '+ add wishlist';

    header("location:./detail_placephp.php");
}
?>