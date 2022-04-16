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
$storeName = $_POST['storeName'];
$address = $_POST['address'];
$tel = $_POST['tel'];
$type = $_POST['type'];
$openingHours = $_POST['openingHours'];
$latitude = $_POST['latitude'];
$longitude = $_POST['longitude'];


$filename = $_FILES[image][tmp_name];// 이미지 처리
$handle = fopen($filename,"rb");
$imageblob = addslashes(fread($handle, filesize($filename)));

// SQL Query 작성
$sql = "INSERT INTO Store (storeName, address, tel, type, openingHours,latitude,longitude,image)
VALUES ('$storeName','$address','$tel','$type','$openingHours','$latitude','$longitude','$imageblob')";
echo $sql;
echo "<br>";

// SQL Query 실행
if(mysqli_query($conn, $sql)){
    echo "Success!";
}
else{
    echo "Error:".$query."mesage:".mysqli_error($conn);
}

mysqli_close($conn);

// 요청이 끝난뒤 페이지를 이동
header('Location:./Store.html');
?>
