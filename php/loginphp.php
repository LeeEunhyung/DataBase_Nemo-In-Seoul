<?
include './dbconn.php';
mysqli_set_charset($conn, 'utf8');

session_start();
$_SESSION['member_id'] = $_POST['id'];
$_SESSION['member_name'] = $_POST['name'];

$sql = "select * from member";
$result = mysqli_query($conn, $sql);

$check_id = $_POST['id']; //입력된 아이디
$check_passwd = $_POST['passwd']; //입력된 비밀번호

$flag = 0;

if($result) {
  while($row = mysqli_fetch_assoc($result)) {
    if($row['member_id'] == $check_id) { //아이디 맞을때
      if($row['password'] == $check_passwd) { //비번 맞을때
        $flag = 1;
        break;
      }
      else { //비번 틀릴때
        $flag = 0;
      }
    }
    else { //아이디 틀릴때
      $flag = 0;
    }
  }

  if($flag == 1) { ?> <script>
    alert('로그인 되었습니다!');
    location.href='../search.html'; </script> <?
  }
  else {
    ?>
    <script>
    alert('잘못된 정보입니다.'+'\n'+'다시 로그인 해주세요!');
    location.href='../login.html';
    </script>
    <?
  }
}
/* close connection */
mysqli_close($conn);
?>