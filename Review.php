<!DOCTYPE html>
<html lang="ko" dir="ltr">
<head>
<meta charset="utf-8">
<title>TestPage</title>
</head>
<body>
    <a href="Menu.php"><button type="button" name="button">menu</button></a>
    <a href="Review.php"><button type="button" name="button">review</button></a>
    <a href="Store.php"><button type="button" name="button">store</button></a>
    <a href="User.php"><button type="button" name="button">user</button></a>
    <br><br>

    
    <form action="reviewinsertdata.php" method = "post">
        ID:<input type="text" name="userID" required><br><br>
        가게:<input type="text" name="storeName" required><br><br>
        리뷰<br><textarea name="review" cols = "30" rows = "5" 
          placeholder="리뷰를 남겨주세요." required></textarea><br><br>
        메뉴:<input type="text" name="menu" required><br><br>
        별점:<input type="range" min = "0" max = "5" name="starRating" required><br><br>
        <input type="submit" value="insert">
    </form>
    <form action="reviewData.php" method = "post">
        <input type = "submit" value = "show json">
    </form>
    <!-- 안드로이드 인서트로 이동 -->
    <form action="reviewinsert.php" method = "post">
        <input type = "submit" value = "Android insert">
    </form>
    <!-- 안드로이드 딜레트로 이동 -->
    <form action="reviewDelete.php" method = "post">
        <input type = "submit" value = "Android delete">
    </form>

    <table>
      <thead>
        <tr>
          <th>userID</th>
          <th>storeName</th>
          <th>review</th>
          <th>menu</th>
          <th>starRating</th>
          <th>date</th>
          <th>Edit</th>
          <th>Delete</th>
        </tr>
      </thead>
      <tbody>
        <?php
          $jb_conn = mysqli_connect( 'localhost', 'root', 'admin', 'test' );
          $deleteuserID = $_POST[ 'deleteuserID' ];
          $deletedate = $_POST[ 'deletedate' ];
          $deletestoreName = $_POST[ 'deletestoreName' ];

          // 유저 아이디와 날짜를 이용하여 삭제
          if ( isset( $deleteuserID ) ) {
            $jb_sql_delete = "DELETE FROM Review WHERE userID = '$deleteuserID' AND date = '$deletedate';";
            if(mysqli_query($jb_conn, $jb_sql_delete)){
                echo '<p style="color: red;"> Menu ' . $deleteuserID . ' - ' . $deletedate . ' is deleted.</p>';
            }
            else{
                echo "Error:".$jb_sql_delete."mesage:".mysqli_error($jb_conn);
            }

            // 삭제된 가게의 별점평균 업데이트
            $sql = "UPDATE Store Set starRatingAvg=(SELECT AVG(starRating) FROM Review
            WHERE storeName='$deletestorename') WHERE storeName='$deletestoreName'";
            if(mysqli_query($jb_conn, $sql)){
            echo "Success!";
            }
            else{
            echo "Error:".$sql."mesage:".mysqli_error($jb_conn);
            }
          }

          $jb_sql = "SELECT * FROM Review;";
          $jb_result = mysqli_query( $jb_conn, $jb_sql );
          while( $jb_row = mysqli_fetch_array( $jb_result ) ) {
            // 수정버튼
            $jb_edit = '
              <form action="reviewEdit.html" method="POST">
              <input type="hidden" name="userID" value="' . $jb_row[ 'userID' ] . '">
              <input type="hidden" name="storeName" value="' . $jb_row[ 'storeName' ] . '">
              <input type="hidden" name="review" value="' . $jb_row[ 'review' ] . '">
              <input type="hidden" name="menu" value="' . $jb_row[ 'menu' ] . '">
              <input type="hidden" name="starRating" value="' . $jb_row[ 'starRating' ] . '">
              <input type="hidden" name="date" value="' . $jb_row[ 'date' ] . '">
              <input type="submit" value="Edit">
              </form>
            ';
            //삭제버튼
            $jb_delete = '
              <form action="Review.php" method="POST">
              <input type="hidden" name="deleteuserID" value="' . $jb_row[ 'userID' ] . '">
              <input type="hidden" name="deletestoreName" value="' . $jb_row[ 'storeName' ] . '">
              <input type="hidden" name="deletedate" value="' . $jb_row[ 'date' ] . '">
                <input type="submit" value="Delete">
              </form>
            ';
            // 출력
            echo '<tr><td>' . $jb_row[ 'userID' ] . '</td><td>'. $jb_row[ 'storeName' ] . '</td><td>'. $jb_row[ 'review' ] . '</td><td>'. $jb_row[ 'menu' ] . '</td><td>'. $jb_row[ 'starRating' ] . '</td><td>'. $jb_row[ 'date' ] . '</td><td>' . $jb_edit . '</td><td>' . $jb_delete . '</td></tr>';
          }
        ?>
      </tbody>
    </table>
</body>
</html>