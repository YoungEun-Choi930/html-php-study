<?php
    $storeName = $_POST['storeName'];
    $address = $_POST['address'];
    $tel = $_POST['tel'];
    $type = $_POST['type'];
    $openingHours = $_POST['openingHours'];
    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];

    $pre_storeName = $_POST['pre_storeName'];

if(is_null($pre_storeName)){
die("Fail");}

$servername = 'localhost'; // 데이터베이스 호스트
$username = 'root'; // 데이터베이스 ID (수정요망)
$password = 'admin'; // 데이터베이스 PW (수정요망)
$dbname = 'test'; //데이터베이스명 (수정요망)
 
$conn = mysqli_connect($servername, $username, $password, $dbname);
if(!$conn) {
    die("mysql connect failed");
}

mysqli_select_db($conn, $dbname) or die('DB선택실패');

$sql = "UPDATE Store SET type='$type', openingHours='$openingHours',latitude=$latitude, longitude=$longitude WHERE storeName='$pre_storeName';";

echo $sql;
echo "<br><br>";

if(mysqli_query($conn, $sql)){
    echo "Success!";
}
else{
    die ( "Error:".$query."mesage:".mysqli_error($conn));
}
$sql = "UPDATE Store SET address='$address', tel='$tel', storeName='$storeName' WHERE storeName='$pre_storeName';";

echo "<br><br>";
echo $sql;
echo "<br><br>";

if(mysqli_query($conn, $sql)){
    echo "Success!";
}
else{
    die ( "Error:".$query."mesage:".mysqli_error($conn));
}

mysqli_close($conn);

header('Location:./Store.php');
?>
