<?
include './dbconn.php';
mysqli_set_charset($conn, 'utf8');
session_start();

unset($_SESSION['member_id']);
unset($_SESSION['member_name']);
unset($_SESSION['member_level']);

unset($_SESSION['cost']);
unset($_SESSION['taking_time']);
unset($_SESSION['likes']);

unset($_SESSION['add_member_id']);
unset($_SESSION['open_time']);
unset($_SESSION['close_time']);

unset($_SESSION['cnt']);
unset($_SESSION['cnt2']);

unset($_SESSION['islike']);
unset($_SESSION['likelabel']);

unset($_SESSION['iswish']);
unset($_SESSION['wishlabel']);
unset($_SESSION['place']);
unset($_SESSION['subway']);
?>
<script>
alert('로그아웃 완료되었습니다.');
location.href='../login.html';
</script>