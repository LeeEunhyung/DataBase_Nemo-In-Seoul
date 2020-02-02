<?
include './dbconn.php';
mysqli_set_charset($conn, 'utf8');
session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="../styles/wishlistcss.css">
  <title>Wish List</title>
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
    <div id="title">
      <center>
        <p id="sitetitle">Wish List</p>
      </center>
    </div>

    <div id="wishlist">
      <form action="./delete_wishphp.php" method="post">
        <?
        $sql = "select * from wishlist where member_id ='".$_SESSION['member_id']."'";
        $result = mysqli_query($conn, $sql);

        if($result) {
          $cnt = 1;
          while($row = mysqli_fetch_assoc($result)) {
            printf("<br>%d. %s", $cnt, $row['place_name']);
        ?>
            <input type = "radio" name = "delete" value = "<? echo $row['place_name'] ?>"><span class="up"></span><br>
            <?
            $cnt = $cnt+1;
          }
        }
        ?>
        <br>
        <input type="submit" value="delete">

      </form>
    </div>
  </main>
</body>
</html>