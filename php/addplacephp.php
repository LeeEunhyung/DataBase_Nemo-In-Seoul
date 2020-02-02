<?
    include './dbconn.php';
    mysqli_set_charset($conn, 'utf8');
    session_start();

    $place_name = $_POST['place_name'];

    $sql = "select * from place";
    $result = mysqli_query($conn, $sql);

    while($row = mysqli_fetch_assoc($result)) {
        if($row['place_name'] == $place_name) { ?>
        <script>
            alert("이미 등록된 장소 입니다!");
            location.href="./resultphp.php";
        </script> <?
        return;
        }
    }
    $sql2 = "insert into place(place_name, address, taking_time, subway, member_id) values('".$_POST['place_name']."','".$_POST['address']."','".$_POST['taking_time']."','".$_SESSION['subway']."','".$_SESSION['member_id']."')";
    mysqli_query($conn, $sql2);

    if ($_POST['cost']!="") {
        $sql3 = "update place set cost='".$_POST['cost']."' where place_name='".$_POST['place_name']."'";
        mysqli_query($conn, $sql3);
    }
    if ($_POST['open_time']!="") {
        $sql4 = "update place set open_time='".$_POST['open_time']."' where place_name='".$_POST['place_name']."'";
        mysqli_query($conn, $sql4);
    }
    if ($_POST['close_time']!="") {
        $sql5 = "update place set close_time='".$_POST['close_time']."' where place_name='".$_POST['place_name']."'";
        mysqli_query($conn, $sql5);
    }
?>
<script>
    alert("장소가 등록되었습니다!");
    location.href="./resultphp.php";
</script>