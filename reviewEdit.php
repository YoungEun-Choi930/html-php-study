<?php
    $review = $_POST['review'];
    $menu = $_POST['menu'];
    $starRating = $_POST['starRating'];

    $pre_userID = $_POST['pre_userID'];
    $pre_date = $_POST['pre_date'];
    $pre_storeName = $_POST['pre_storeName'];

if(is_null($pre_userID)){
die("Fail");}

$servername = 'localhost'; // 데이터베이스 호스트
$username = 'root'; // 데이터베이스 ID (수정요망)
$password = 'admin'; // 데이터베이스 PW (수정요망)
$dbname = 'test'; //데이터베이스명 (수정요망)

// connect
$conn = mysqli_connect($servername, $username, $password, $dbname);
if(!$conn) {
    die("mysql connect failed");
}

mysqli_select_db($conn, $dbname) or die('DB선택실패');

// 쿼리 작성
$sql = "UPDATE Review SET review='$review', menu='$menu',starRating=$starRating, date=NOW() WHERE userID='$pre_userID' AND date='$pre_date';";

echo $sql;
echo "<br><br>";

// 실행
if(mysqli_query($conn, $sql)){
    echo "Success!";
}
else{
    die ( "Error:".$query."mesage:".mysqli_error($conn));
}

// 별점 평균 업데이트 쿼리 작성 실행
$sql = "UPDATE Store Set starRatingAvg=(SELECT AVG(starRating) FROM Review
        WHERE storeName='$pre_storeName') WHERE storeName='$pre_storeName'";
if(mysqli_query($conn, $sql)){
    echo "Success!";
}
else{
    echo "Error:".$query."mesage:".mysqli_error($conn);

mysqli_close($conn);

header('Location:./Store.php');
?>
