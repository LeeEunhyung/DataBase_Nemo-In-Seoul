<?
include './dbconn.php';
mysqli_set_charset($conn, 'utf8');
session_start();

if ($_POST['subway']!="") {
  $_SESSION['subway'] = $_POST['subway'];
}

if ($_SESSION['subway']==0) { ?> <script>
    alert("호선을 선택해주세요!");
    location.href='../search.html'; </script> <?
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../styles/resultcss.css">
    <title>Result</title>
</head>
<body>
    <header>
       <div>
            <p><b>　　안녕하세요, <? echo $_SESSION['member_name'] ?>님! :)</b></p>
        </div>
       <div id="headerbut">
           <div><p class="header_b"><b><a href="../search.html">Search</a></b></div>
           <div><p class="header_b"><b><a href="./wishlistphp.php">Wishlist</a></b></p></div>
           <div><p class="header_b"><b><a href="../mypage.html">Mypage</a></b></p></div>
           <div><p class="header_b"><b><a href="./logoutphp.php">Logout</a></b></p></div>
       </div>
    </header>
    <main>
      <div>
        <div id="map">
          <div id="num_space">
            <p id="subwaynum" style="color: blue;"><b><? echo $_SESSION['subway'] ?></b></p>
          </div>
          <div id="subwayimg">
            <center><img src="../images/1.png" width="450px;" style="margin-top:30px;"></center>
          </div>
        </div>
      </div>

      <center><input id="addplace" onclick="add_place()" type="button" value="=> <? echo $_SESSION['subway'] ?>호선에 장소 추가하기!"></center>
      
      <div id="placelist">
        <div id="list">
          <div id="list_search">
            <br>
            <center>
              ♡ 좋아요를 기준으로 한 <b><? echo $_SESSION['subway'] ?>호선</b> 목록입니다!
              <form action="./detail_placephp.php" method="post">
                자세히 볼 장소 입력: <input type="text" name="place" placeholder="ex) 세종대학교">
                <input type="submit" value="search!">
              </form>
            </center>
          </div>
          <div id="review">
            <div id="review_menu">
              <div id="list_menu">
               <div class="rm"><center>번호</center></div>
               <div class="rm"><center>장소</center></div>
               <div class="rm"><center>좋아요</center></div>
               <div><center>작성자</center></div>
             </div>

             <div id="list_place">
               <div class="rm"><center>
                 <?
                 $sql = "select * from place where subway='".$_SESSION['subway']."' order by likes desc";

                 $result = mysqli_query($conn, $sql);

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
                 $sql = "select * from place where subway='".$_SESSION['subway']."' order by likes desc";

                 $result = mysqli_query($conn, $sql);

                 if ($result) {
                 while ($row = mysqli_fetch_assoc($result)) {
                     printf("%s<br>", $row['place_name']);
                 }
                 }
                 ?>
               </center></div>

               <div class="rm"><center>
                 <?
                 $sql = "select * from place where subway='".$_SESSION['subway']."' order by likes desc";

                 $result = mysqli_query($conn, $sql);

                 if ($result) {
                 while ($row = mysqli_fetch_assoc($result)) {
                     printf("%d<br>", $row['likes']);
                   }
                 }
                 ?>
               </center></div>

               <div><center>
                 <?
                 $sql = "select * from place where subway='".$_SESSION['subway']."' order by likes desc";

                 $result = mysqli_query($conn, $sql);

                 if ($result) {
                 while ($row = mysqli_fetch_assoc($result)) {
                     printf("%s<br>", $row['member_id']);
                   }
                 }
                 ?>
               </center></div>
             </div>

            </div>
          </div>
        </div>
      </div>
    </main>
  </body>
</html>
<script>
    var subway_num=<? echo $_SESSION['subway'] ?>;
    var addbut = document.getElementById('addplace');

    function add_place() {
      location.href="../addplace.html";
      }


    if (subway_num==1) {
        document.getElementById('num_space').innerHTML=`<p id="subwaynum" style="color: blue;"><b>${subway_num}</b></p>`;
        document.getElementById('subwayimg').innerHTML=` <center><img src="../images/1.png" width="450px;" style="margin-top:30px;"></center>`;
    }
    else if (subway_num==2) {
        document.getElementById('num_space').innerHTML=`<p id="subwaynum" style="color: green;"><b>${subway_num}</b></p>`;
        document.getElementById('subwayimg').innerHTML=` <center><img src="../images/2.png" width="450px;" style="margin-top:30px;"></center>`;
    }
    else if (subway_num==3) {
        document.getElementById('num_space').innerHTML=`<p id="subwaynum" style="color: orange;"><b>${subway_num}</b></p>`;
        document.getElementById('subwayimg').innerHTML=` <center><img src="../images/3.png" width="450px;" style="margin-top:30px;"></center>`;
    }
    else if (subway_num==4) {
        document.getElementById('num_space').innerHTML=`<p id="subwaynum" style="color: blue;"><b>${subway_num}</b></p>`;
        document.getElementById('subwayimg').innerHTML=` <center><img src="../images/4.png" width="450px;" style="margin-top:30px;"></center>`;
    }
    else if (subway_num==5) {
        document.getElementById('num_space').innerHTML=`<p id="subwaynum" style="color: #8041D9;"><b>${subway_num}</b></p>`;
        document.getElementById('subwayimg').innerHTML=` <center><img src="../images/5.png" width="450px;" style="margin-top:30px;"></center>`;
    }
    else if (subway_num==6) {
        document.getElementById('num_space').innerHTML=`<p id="subwaynum" style="color: brown;"><b>${subway_num}</b></p>`;
        document.getElementById('subwayimg').innerHTML=` <center><img src="../images/6.png" width="450px;" style="margin-top:30px;"></center>`;
    }
    else if (subway_num==7) {
        document.getElementById('num_space').innerHTML=`<p id="subwaynum" style="color: #AB9C12;"><b>${subway_num}</b></p>`;
        document.getElementById('subwayimg').innerHTML=` <center><img src="../images/7.png" width="450px;" style="margin-top:30px;"></center>`;
    }
    else if (subway_num==8) {
        document.getElementById('num_space').innerHTML=`<p id="subwaynum" style="color: pink;"><b>${subway_num}</b></p>`;
        document.getElementById('subwayimg').innerHTML=` <center><img src="../images/8.png" width="450px;" style="margin-top:30px;"></center>`;
    }
    else if (subway_num==9) {
        document.getElementById('num_space').innerHTML=`<p id="subwaynum" style="color: #997000;"><b>${subway_num}</b></p>`;
        document.getElementById('subwayimg').innerHTML=` <center><img src="../images/9.png" width="450px;" style="margin-top:30px;"></center>`;
    }
</script>