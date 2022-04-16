<!DOCTYPE html>
<html lang="ko" dir="ltr">
<head>
<meta charset="utf-8">
<title>TestPage</title>
</head>
<body>
    <a href="Menu.php"><button type="button" name="button">menu</button></a>
    <a href="Review.html"><button type="button" name="button">review</button></a>
    <a href="Store.html"><button type="button" name="button">store</button></a>
    <a href="User.php"><button type="button" name="button">user</button></a>
    <br><br>

    <form action="menuinsert.php" method = "post">
        메뉴:<input type="text" name="menu_menu" required><br><br>
        가게:<input type="text" name="menu_storeName" required><br><br>
        가격:<input type="number" name="menu_price" required><br><br>
        타입:<input type="text" name="menu_menuType" required><br><br>
    <input type="submit" value="insert">
    </form>
    <form action="menuData.php" method = "post">
        <input type = "submit" value = "show json">
    </form>
    <form action="menuSelectStore.php" method = "post">
        <input type = "submit" value = "SelectStore">
    </form>

    <table>
      <thead>
        <tr>
          <th>menu</th>
          <th>storeName</th>
          <th>price</th>
          <th>menuType</th>
          <th>Edit</th>
          <th>Delete</th>
        </tr>
      </thead>
      <tbody>
        <?php
          // 삭제할 정보 받아오기
          $jb_conn = mysqli_connect( 'localhost', 'root', 'admin', 'test' );
          $deletemenu = $_POST[ 'deletemenu' ];
          $deletestoreName = $_POST[ 'deletestoreName' ];

          // 메뉴이름이랑 가게이름으로 선택해서 메뉴 삭제
          if ( isset( $deletemenu ) ) {
            $jb_sql_delete = "DELETE FROM Menu WHERE menu = '$deletemenu' AND storeName = '$deletestoreName';";
            if(mysqli_query($jb_conn, $jb_sql_delete)){
                echo '<p style="color: red;"> Menu ' . $deletemenu . ' - ' . $deletestoreName . ' is deleted.</p>';
            }
            else{
                echo "Error:".$jb_sql_delete."mesage:".mysqli_error($jb_conn);
            }
          }

          // 메뉴 출력
          $jb_sql = "SELECT * FROM Menu;";
          $jb_result = mysqli_query( $jb_conn, $jb_sql );
          while( $jb_row = mysqli_fetch_array( $jb_result ) ) {
            // 수정버튼 menuEdit.html로 이동
            $jb_edit = '
              <form action="menuEdit.html" method="POST">
              <input type="hidden" name="menu" value="' . $jb_row[ 'menu' ] . '">
              <input type="hidden" name="storeName" value="' . $jb_row[ 'storeName' ] . '">
              <input type="hidden" name="price" value="' . $jb_row[ 'price' ] . '">
              <input type="hidden" name="menuType" value="' . $jb_row[ 'menuType' ] . '">
              <input type="submit" value="Edit">
              </form>
            ';
            // 삭제버튼 
            $jb_delete = '
              <form action="Menu.php" method="POST">
                <input type="hidden" name="deletemenu" value="' . $jb_row[ 'menu' ] . '">
                <input type="hidden" name="deletestoreName" value="' . $jb_row[ 'storeName' ] . '">
                <input type="submit" value="Delete">
              </form>
            ';
            // 출력
            echo '<tr><td>' . $jb_row[ 'menu' ] . '</td><td>'. $jb_row[ 'storeName' ] . '</td><td>' . $jb_row[ 'price' ] . '</td><td>' . $jb_row[ 'menuType' ] . '</td><td>' . $jb_edit . '</td><td>' . $jb_delete . '</td></tr>';          }
        ?>
      </tbody>
    </table>
</body>
</html>