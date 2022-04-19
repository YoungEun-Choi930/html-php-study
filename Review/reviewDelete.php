<?php 

//안드로이드 딜레트
    error_reporting(E_ALL); 
    ini_set('display_errors',1); 

    include('dbcon.php');


    $android = strpos($_SERVER['HTTP_USER_AGENT'], "Android");


    if( (($_SERVER['REQUEST_METHOD'] == 'POST') && isset($_POST['submit'])) || $android )
    {


        $userID = $_POST['userID'];
        $storeName = $_POST['storeName'];
        $date = $_POST['date'];

        if(empty($userID)){
            $errMSG = "이름을 입력하세요.";
        }
        else if(empty($storeName)){
            $errMSG = "가게이름을 입력하세요.";
        }
        else if(empty($date)){
            $errMSG = "날짜를 입력하세요.";
        }
        if(!isset($errMSG))
        {
            try{
                // 삭제 쿼리 입력. 
                $stmt = $con->prepare('DELETE FROM Review WHERE userID = :userID 
                AND date = STR_TO_DATE(:date, "%Y-%m-%d %H:%i:%S")');
                $stmt->bindParam(':userID', $userID);
                $stmt->bindParam(':date', $date);

                if($stmt->execute())
                {
                    $successMSG = "삭제완료.";
                }
                else
                {
                    $errMSG = "삭제실패";
                }

                // 가게 별점평균 업데이트
                $stmt = $con->prepare('UPDATE Store Set starRatingAvg=(SELECT ROUND(AVG(starRating),1) FROM Review
                WHERE storeName=:storeName) WHERE storeName=:storeName');
                $stmt->bindParam(':storeName',$storeName);
                $stmt->execute();

            } catch(PDOException $e) {
                die("Database error: " . $e->getMessage()); 
            }
        }

    }

?>


<?php 
    if (isset($errMSG)) echo $errMSG;
    if (isset($successMSG)) echo $successMSG;

	$android = strpos($_SERVER['HTTP_USER_AGENT'], "Android");
   
    if( !$android )
    {
?>
    <html>
       <body>

            <form action="<?php $_PHP_SELF ?>" method="POST">
                userID: <input type="text" name="userID"/>
                storeName: <input type="text" name="storeName"/>
                date: <input type="text" name="date"/>
                <input type = "submit" name = "submit" />
            </form>
       
       </body>
    </html>

<?php 
    }
?>

