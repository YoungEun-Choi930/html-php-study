<?php
    $pre_userID = $_POST['pre_userID'];
    $userName = $_POST['user_userName'];
    $userID = $_POST['user_userID'];
if(is_null($pre_userID)){
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

$sql = "UPDATE User set userID='$userID', userName='$userName' WHERE userID='$pre_userID'";
echo $sql;
echo "<br>";

if(mysqli_query($conn, $sql)){
    echo "Success!";
}
else{
    echo ( "Error:".$query."mesage:".mysqli_error($conn));
}

mysqli_close($conn);

header('Location:User.php');
?>
