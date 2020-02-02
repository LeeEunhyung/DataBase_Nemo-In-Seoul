<?
include './dbconn.php';
mysqli_set_charset($conn, 'utf8');
session_start();

$sql = "select * from place where place_name='".$_POST['place']."'";
$result = mysqli_query($conn, $sql);

if($result) {
    if($row2 = mysqli_fetch_assoc($result)) {
      if ($_SESSION['subway'] != $row2['subway']) {
        ?>
        <script>
          alert('해당 장소가 검색되지 않습니다. 호선을 다시 선택해주세요!');
          location.href="../search.html";
        </script>
        <?
        return;
      }
    }

  }

if ($_POST['place']!="") {
    $_SESSION['place'] = $_POST['place'];
}

$sql = "select * from place where place_name='".$_SESSION['place']."'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_row($result);

 $_SESSION['likes'] = $row[4];

if ($_SESSION['cnt']==0) {
    $_SESSION['islike']=1;
    $_SESSION['likelabel']='♡ click like';
}

if ($_SESSION['cnt2']==0) {
    $_SESSION['iswish']=1;
    $_SESSION['wishlabel']='+ add wishlist';
}

$chk_sql = "select * from wishlist where place_name='".$_SESSION['place']."' and member_id='".$_SESSION['member_id']."'";
$chk_result = mysqli_query($conn, $chk_sql);
$row = mysqli_fetch_row($chk_result);

if($row[2]==$_SESSION['place'] && $row[1]==$_SESSION['member_id']) {
    $_SESSION['iswish'] = 0;
    $_SESSION['wishlabel'] = '- delete wishlist';
}
else {
    $_SESSION['iswish'] = 1;
    $_SESSION['wishlabel'] = '+ add wishlist';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../styles/detail_placecss.css">
    <title>Place Information</title>
</head>
<body>
    <header>
       <div>
            <p><b>　　안녕하세요, <? echo $_SESSION['member_id'] ?>님! :)</b></p>
        </div>
       <div id="headerbut">
           <div><p class="header_b"><b><a href="../search.html">Search</a></b></div>
           <div><p class="header_b"><b><a href="./wishlistphp.php">Wishlist</a></b></p></div>
           <div><p class="header_b"><b><a href="../mypage.html">Mypage</a></b></p></div>
           <div><p class="header_b"><b><a href="./logoutphp.php">Logout</a></b></p></div>
       </div>
    </header>
    <main>
        <div id="place">
            <div id="left">
                <center><img src="../images/seoul.png" width="270px" style="margin-top:20px;"></center>
            </div>
            <div id="right">
                <div id="up">
                    <center><b id="place_name"><? printf("%s호선 %s", $_SESSION['subway'], $_SESSION['place']); ?></b></center>
                </div>
                <div id="down">
                    <?
                        $sql2 = "select * from place where place_name='".$_SESSION['place']."'";
                        $result2 = mysqli_query($conn, $sql2);
                        $row2 = mysqli_fetch_row($result2);
                        
                        printf("* %s 에 위치해 있습니다.", $row2[1]); echo "<br>";
                        printf("* 이 장소에서 예상 지출 비용은 %s원 입니다.", $row2[2]); echo "<br>";
                        printf("* 이 장소에서 예상 소요 시간은 %s시간 입니다.", $row2[3]); echo "<br>";
                        printf("* 좋아요 개수는 %s개 입니다.", $_SESSION['likes']); echo "<br>";
                        printf("* 지하철 %s호선에 있습니다.", $_SESSION['subway']); echo "<br>";
                        printf("* 이 장소의 추천인 Id는 %s 입니다.", $row2[6]); echo "<br>";
                        printf("* 오픈 시간은 %s 입니다.", $row2[7]); echo "<br>";
                        printf("* 마감 시간은 %s 입니다.", $row2[8]);
                    ?>
                </div>
            </div>
        </div>

        <div id="but_bar">
            <center>
                <form action="./testlike.php" method="post">
                    <input type="text" name="likecheck" value="<? echo $_SESSION['islike'] ?>" style="display:none;">
                    <input id="like" type="submit" class="bar" value="<? echo $_SESSION['likelabel'] ?>">
                </form>
                <form action="./testwish.php" method="post">
                    <input type="text" name="wishcheck" value="<? echo $_SESSION['iswish'] ?>" style="display:none;">
                    <input id="wish" type="submit" class="bar" value="<? echo $_SESSION['wishlabel'] ?>">
                </form>
                <input type="button" onclick="add_review()" id="addreview" value="=> <? echo $_SESSION['place'] ?>에 리뷰 추가하기!">
            </center>
        </div>
        <div id="review">
            <div id="review_menu">
                <div class="rm"><center>No.</center></div>
                <div class="rm"><center>Id</center></div>
                <div><center>Contents</center></div>
            </div>

            <div id="review_cmt">
              <div class="rm"><center>
                <?
                $sql = "select * from review where place_name='".$_SESSION['place']."'";

                $result = mysqli_query($conn, $sql);

                $check_place = $_POST['place'];

                $cnt = 1;
                if ($result) {
                while ($row = mysqli_fetch_assoc($result)) {
                  printf("%d<br>", $cnt);
                  $cnt = $cnt+1;
                }
            }
                ?>
              </center></div>
              <div class="rm"><center>
                <?
                $sql = "select * from review where place_name='".$_SESSION['place']."'";

                $result = mysqli_query($conn, $sql);

                $check_place = $_POST['place'];

                if ($result) {
                while ($row = mysqli_fetch_assoc($result)) {
                  printf("%s<br>", $row['member_id']);
                }
            }
                ?>
              </center></div>
              <div><center>
                <?
                $sql = "select * from review where place_name='".$_SESSION['place']."'";

                $result = mysqli_query($conn, $sql);

                $check_place = $_POST['place'];

                if ($result) {
                while ($row = mysqli_fetch_assoc($result)) {
                  printf("%s<br>", $row['contents']);
                }
            }
                ?>
              </center></div>
          </div>
        </div>
    </main>
</body>
</html>
<script>
    function add_review() {
      location.href="../addreview.html";
      }
</script>