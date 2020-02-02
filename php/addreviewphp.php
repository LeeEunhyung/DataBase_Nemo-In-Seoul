<?
    include './dbconn.php';
    mysqli_set_charset($conn, 'utf8');
    session_start();

    $contents = $_POST['contents'];

    if ($contents=="") { ?>
        <script>
            alert("내용을 입력해주세요!");
            location.href="../addreview.html";
            return;
        </script> <?
    }
    $place_name = $_SESSION['place'];

    $sql = "select * from review";
    $result = mysqli_query($conn, $sql);

    while($row = mysqli_fetch_assoc($result)) {
        if($row['place_name']==$place_name && $row['member_id']==$_SESSION['member_id']) { ?>
        <script>
            alert("이미 리뷰를 등록했습니다!");
            location.href="./detail_placephp.php";
        </script> <?
        return;
        }
    }
    $sql2 = "insert into review(member_id, place_name, contents, subway) values('".$_SESSION['member_id']."','".$_SESSION['place']."', '$contents', '".$_SESSION['subway']."')";  
    mysqli_query($conn, $sql2);

    $num_sql = "alter table review AUTO_INCREMENT = 1";
    $num_result = mysqli_query($conn, $num_sql);

    $num_sql = "set @count=0";
    $num_result = mysqli_query($conn, $num_sql);

    $num_sql = "update review SET num = @COUNT:=@COUNT+1";
    $num_result = mysqli_query($conn, $num_sql);

?>
<script>
    alert("리뷰가 등록되었습니다!");
    location.href="./detail_placephp.php";
</script>