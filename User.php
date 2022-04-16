<!DOCTYPE html>
<html lang="ko" dir="ltr">
<head>
<meta charset="utf-8">
<title>TestPage</title>
</head>
<body>
    <a href="Menu.html"><button type="button" name="button">menu</button></a>
    <a href="Review.html"><button type="button" name="button">review</button></a>
    <a href="Store.html"><button type="button" name="button">store</button></a>
    <a href="User.html"><button type="button" name="button">user</button></a>
    <br><br>

    <form action="userinsertdata.php" method = "post">
        이름:<input type="text" name="userName" required><br><br>
        ID:<input type="text" name="userID" required><br><br>
    <input type="submit" value="insert">
    </form>
    <form action="userData.php" method = "post">
        <input type = "submit" value = "show json">
    </form>
    <form action="userinsert.php" method = "post">
        <input type = "submit" value = "Android insert">
      </form>

    <table>
      <thead>
        <tr>
          <th>userName</th>
          <th>userID</th>
          <th>Edit</th>
          <th>Delete</th>
        </tr>
      </thead>
      <tbody>
        <?php
          $jb_conn = mysqli_connect( 'localhost', 'root', 'admin', 'test' );
          $deleteUserID = $_POST[ 'deleteUserID' ];
          echo $deleteUserID;
          if ( isset( $deleteUserID ) ) {
            $jb_sql_delete = "DELETE FROM User WHERE userID = '$deleteUserID';";
            if(mysqli_query($jb_conn, $jb_sql_delete)){
                echo '<p style="color: red;"> User ' . $deleteUserID . ' is deleted.</p>';
            }
            else{
                echo "Error:".$jb_sql_delete."mesage:".mysqli_error($jb_conn);
            }
          }
          $jb_sql = "SELECT * FROM User;";
          $jb_result = mysqli_query( $jb_conn, $jb_sql );
          while( $jb_row = mysqli_fetch_array( $jb_result ) ) {
            $jb_edit = '
              <form action="userEdit.html" method="POST">
              <input type="hidden" name="user_userID" value="' . $jb_row[ 'userID' ] . '">
              <input type="hidden" name="user_userName" value="' . $jb_row[ 'userName' ] . '">
                <input type="submit" value="Edit">
              </form>
            ';
            $jb_delete = '
              <form action="User.php" method="POST">
                <input type="hidden" name="deleteUserID" value="' . $jb_row[ 'userID' ] . '">
                <input type="submit" value="Delete">
              </form>
            ';
            echo '<tr><td>' . $jb_row[ 'userName' ] . '</td><td>'. $jb_row[ 'userID' ] . '</td><td>' . $jb_edit . '</td><td>' . $jb_delete . '</td></tr>';
          }
        ?>
      </tbody>
    </table>
</body>
</html>