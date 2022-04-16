<?php
// 넘어온 값
$pre_menu = $_POST['pre_menu'];
$pre_storeName = $_POST['pre_storeName'];
$menu = $_POST['menu'];
$storeName = $_POST['storeName'];
$price = $_POST['price'];
$menuType = $_POST['menuType'];

if(is_null($pre_menu)){
    die("Fail");}

// 서버연결
$servername = 'localhost'; // 데이터베이스 호스트
$username = 'root'; // 데이터베이스 ID (수정요망)
$password = 'admin'; // 데이터베이스 PW (수정요망)
$dbname = 'test'; //데이터베이스명 (수정요망)
 
$conn = mysqli_connect($servername, $username, $password, $dbname);
if(!$conn) {
    die("mysql connect failed");
}

mysqli_select_db($conn, $dbname) or die('DB선택실패');

// 수정하는 쿼리
$sql = "UPDATE Menu SET menu='$menu', storeName='$storeName', price='$price', menuType='$menuType'
WHERE menu='$pre_menu'AND storeName='$storeName';";
echo $sql;
echo "<br>";

// 쿼리실행
if(mysqli_query($conn, $sql)){
    echo "Success!";
}
else{
    die ( "Error:".$query."mesage:".mysqli_error($conn));
}

mysqli_close($conn);

// 이동
header('Location:./Menu.php');
?>
