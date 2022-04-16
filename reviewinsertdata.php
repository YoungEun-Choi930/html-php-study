<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<?php
// 그냥 인서트
$servername = 'localhost'; // 데이터베이스 호스트
$username = 'root'; // 데이터베이스 ID (수정요망)
$password = 'admin'; // 데이터베이스 PW (수정요망)
$dbname = 'test'; //데이터베이스명 (수정요망)
 
$conn = mysqli_connect($servername, $username, $password, $dbname);
if(!$conn) {
    die("mysql connect failed");
}

mysqli_select_db($conn, $dbname) or die('DB선택실패');

$userID = $_POST['userID'];
$storeName = $_POST['storeName'];
$review = $_POST['review'];
$menu = $_POST['menu'];
$starRating = $_POST['starRating'];

$sql = "INSERT INTO Review (userID,storeName,review,menu,starRating,date)
VALUES ('$userID','$storeName','$review','$menu','$starRating',NOW())";
echo $sql;
echo "<br>";

if(mysqli_query($conn, $sql)){
    echo "Success!";
}
else{
    echo "Error:".$query."mesage:".mysqli_error($conn);
}

$sql = "UPDATE Store Set starRatingAvg=(SELECT AVG(starRating) FROM Review
WHERE storeName='$storeName') WHERE storeName='$storeName'";
if(mysqli_query($conn, $sql)){
    echo "Success!";
}
else{
    echo "Error:".$query."mesage:".mysqli_error($conn);
}

mysqli_close($conn);

header('Location:http://localhost/Review.html');
?>
