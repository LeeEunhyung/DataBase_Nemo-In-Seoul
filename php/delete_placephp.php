<?
include './dbconn.php';
mysqli_set_charset($conn, 'utf8');
session_start();

if($_POST['delete'] == "") {
  ?>
  <script>
    alert('선택된 장소가 없습니다. 다시 선택해주세요!');
    location.href="../mypage.html";
  </script>
  <?
  return;
}

$sql = "select * from place where member_id ='".$_SESSION['member_id']."' and place_name ='".$_POST['delete']."'";
$result = mysqli_query($conn, $sql);

if($result) {
  if($row = mysqli_fetch_assoc($result)) {
    $del_sql = "delete from place where member_id='".$_SESSION['member_id']."' and place_name='".$_POST['delete']."'";
    $del_result = mysqli_query($conn, $del_sql);

    $num_sql = "alter table place AUTO_INCREMENT = 1";
    $num_result = mysqli_query($conn, $num_sql);

    $num_sql = "set @count=0";
    $num_result = mysqli_query($conn, $num_sql);

    $num_sql = "update place SET num = @COUNT:=@COUNT+1";
    $num_result = mysqli_query($conn, $num_sql);
  }

  ?>
  <script>
    alert('선택된 장소가 삭제되었습니다!');
    location.href="../mypage.html";
  </script>
  <?
}
?>
