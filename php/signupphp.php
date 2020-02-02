<?
    include './dbconn.php';
    $id = $_POST['id'];
    $name = $_POST['name'];
    $passwd = $_POST['passwd'];

    $sql = "select * from member";
    $result = mysqli_query($conn, $sql);

    while($row = mysqli_fetch_assoc($result)) {
        if($row['member_id'] == $id) { ?>
        <script>
            alert("존재하는 Id입니다. 다시 입력해주세요!");
            location.href="../signup.html";
        </script> <?
        }
    }


    if ($id=="" || $name=="" || $passwd=="") { ?>
        <script>
            alert("Id, Name, Password는 필수 항목입니다. 다시 입력해주세요!");
            location.href='../signup.html';
        </script> <?
    }
    else if (!preg_match("/^[a-z]/i", $id) || !preg_match("/^[a-z]/i", $passwd)) { ?>
        <script>
            alert("Id, Password는 영숫자 혼용으로 입력해주세요!");
            location.href='../signup.html';
        </script>
    <?} 
    else {
      $str_birth = $_POST['year'].$_POST['month'].$_POST['date'];
        $birth = date("Y-m-d", strtotime($str_birth));
        
        if ($_POST['year']==="" || $_POST['month']==="" || $_POST['date']==="") {
            $sql = "insert into member(member_id, member_name, password) values('".$_POST['id']."','".$_POST['name']."','".$_POST['passwd']."')";
        } else {
        $sql = "insert into member(member_id, member_name, password, birthday) values('".$_POST['id']."','".$_POST['name']."','".$_POST['passwd']."', '$birth')";
        }
        mysqli_set_charset($conn, 'utf8');
        $result = mysqli_query($conn, $sql); ?>
        <script>
            alert("가입이 완료되었습니다. 다시 로그인 해주세요!");
            location.href='../login.html';
        </script> <?
    }
?>