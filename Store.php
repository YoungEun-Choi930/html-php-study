<!DOCTYPE html>
<html lang="ko" dir="ltr">
<head>
<meta charset="utf-8">
<title>TestPage</title>
</head>
<body>
    <a href="Menu.php"><button type="button" name="button">menu</button></a>
    <a href="Review.html"><button type="button" name="button">review</button></a>
    <a href="Store.php"><button type="button" name="button">store</button></a>
    <a href="User.php"><button type="button" name="button">user</button></a>
    <br><br>

    
  <form action="storeinsert.php" method = "post">
    <input type="text" name="storeName" placeholder="가게이름" required><br><br>
    <input type="text" name="address" placeholder="주소" required><br><br>
    <input type="text" name="tel" placeholder="전화번호"
    pattern="[0-9]{2,3}-[0-9]{3,4}-[0-9]{4}" title = "00*-000*-0000 형식으로 입력해 주세요."><br><br>
    <input type="text" name="type" placeholder="타입" required><br><br>
    <input type="text" name="openingHours" placeholder="영업시간"
    pattern="[0-2]{1}[0-9]{1}:[0-5]{1}[0-9]{1}~[0-2]{1}[0-9]{1}:[0-5]{1}[0-9]{1}" title="00:00~00:00 형식으로 입력해주세요."><br><br>
    <input type="number" name="latitude" placeholder="위도" min="-90" max="90" step="0.0000001" required><br><br>
    <input type="number" name="longitude" placeholder="경도" min="-180" max="180" step="0.0000001" required><br><br>
    image: <input type='file' name="image"><br><br>

    <input type="submit" value="insert"><br><br>
    

  </form>
    <form action="userData.php" method = "post">
        <input type = "submit" value = "show json">
    </form>

    <table>
      <thead>
        <tr>
          <th>storeName</th>
          <th>address</th>
          <th>tel</th>
          <th>type</th>
          <th>openingHours</th>
          <th>latitude</th>
          <th>longitude</th>
          <th>image</th>
          <th>starAVG</th>
          <th>Edit</th>
          <th>Delete</th>
        </tr>
      </thead>
      <tbody>
        <?php
          $jb_conn = mysqli_connect( 'localhost', 'root', 'admin', 'test' );
          $delete_storeName = $_POST[ 'delete_storeName' ];
          
          if ( isset( $delete_storeName ) ) {
            $jb_sql_delete = "DELETE FROM Store WHERE storeName = '$delete_storeName';";
            if(mysqli_query($jb_conn, $jb_sql_delete)){
                echo '<p style="color: red;"> Store ' . $delete_storeName . ' is deleted.</p>';
            }
            else{
                echo "Error:".$jb_sql_delete."mesage:".mysqli_error($jb_conn);
            }
          }
          $jb_sql = "SELECT * FROM Store;";
          $jb_result = mysqli_query( $jb_conn, $jb_sql );
          while( $jb_row = mysqli_fetch_array( $jb_result ) ) {
            $jb_edit = '
              <form action="editStore.html" method="POST">
              <input type="hidden" name="storeName" value="' . $jb_row[ 'storeName' ] . '">
              <input type="hidden" name="address" value="' . $jb_row[ 'address' ] . '">
              <input type="hidden" name="tel" value="' . $jb_row[ 'tel' ] . '">
              <input type="hidden" name="type" value="' . $jb_row[ 'type' ] . '">
              <input type="hidden" name="openingHours" value="' . $jb_row[ 'openingHours' ] . '">
              <input type="hidden" name="latitude" value="' . $jb_row[ 'latitude' ] . '">
              <input type="hidden" name="longitude" value="' . $jb_row[ 'longitude' ] . '">

                <input type="submit" value="Edit">
              </form>
            ';
            $jb_delete = '
              <form action="Store.php" method="POST">
                <input type="hidden" name="delete_storeName" value="' . $jb_row[ 'storeName' ] . '">
                <input type="submit" value="Delete">
              </form>
            ';
            echo '<tr><td>' . $jb_row[ 'storeName' ] . '</td><td>'. $jb_row[ 'address' ] . '</td><td>'. $jb_row[ 'tel' ] . '</td><td>'. $jb_row[ 'type' ] . '</td><td>'. $jb_row[ 'openingHours' ] . '</td><td>'. $jb_row[ 'latitude' ] . '</td><td>'. $jb_row[ 'longitude' ] . '</td><td>'. $jb_row[ 'image' ] . '</td><td>' . $jb_row[ 'starRatingAvg' ] . '</td><td>' . $jb_edit . '</td><td>' . $jb_delete . '</td></tr>';
          }
        ?>
      </tbody>
    </table>
</body>
</html>