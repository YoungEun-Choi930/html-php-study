<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<?php

$servername = 'localhost'; // 데이터베이스 호스트
$username = 'root'; // 데이터베이스 ID (수정요망)
$password = 'admin'; // 데이터베이스 PW (수정요망)
$dbname = 'test'; //데이터베이스명 (수정요망)
 
// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if(!$conn) {
    die("mysql connect failed");
}

// Select DB
mysqli_select_db($conn, $dbname) or die('DB선택실패');

// Form에서 넘어온 데이터
$menu = $_POST['menu_menu'];
$storeName = $_POST['menu_storeName'];
$price = $_POST['menu_price'];
$menuType = $_POST['menu_menuType'];
echo $menu;
echo $storeName;
echo $price;
echo $menuType;
// SQL Query 작성
$sql = "INSERT INTO Menu (menu, storeName, price, menuType)
VALUES ('$menu', '$storeName', '$price', '$menuType')";

// SQL Query 실행
if(mysqli_query($conn, $sql)){
    echo "Success!";
}
else{
    echo "Error:".$query."mesage:".mysqli_error($conn);
}

mysqli_close($conn);

// 요청이 끝난뒤 페이지를 이동
header('Location:./Menu.html');
?>

