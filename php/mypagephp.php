<?
include './dbconn.php';
mysqli_set_charset($conn, 'utf8');
session_start();

$birth = date("Y-m-d", strtotime($_POST['birthday']));

if($_POST['name'] != "" || $_POST['passwd'] != "" || $birth != "") {
  if($_POST['name'] != "") {
    $sql1 = "update member set member_name='".$_POST['name']."' where member_id='".$_SESSION['member_id']."'";
    mysqli_query($conn, $sql1);
    }
  if($_POST['passwd'] != "") {
    $sql2 = "update member set password='".$_POST['passwd']."' where member_id='".$_SESSION['member_id']."'";
    mysqli_query($conn, $sql2);
  }
  if($birth != "") {
    $sql3 = "update member set birthday='".$birth."' where member_id='".$_SESSION['member_id']."'";
    mysqli_query($conn, $sql3);
  }
  ?>
  <script>
  alert('정보가 변경되었습니다. 다시 로그인해주세요!');
  location.href='../login.html';
  </script>
  <?
}
else {
  ?>
  <script>
  alert('변경된 정보가 없습니다.');
  location.href='./mypagephp.php';
  </script>
  <?
}
?>
