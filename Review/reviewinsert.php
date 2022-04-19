<?php 
//안드로이드 리뷰 인서트
    error_reporting(E_ALL); 
    ini_set('display_errors',1); 

    include('dbcon.php');


    $android = strpos($_SERVER['HTTP_USER_AGENT'], "Android");


    if( (($_SERVER['REQUEST_METHOD'] == 'POST') && isset($_POST['submit'])) || $android )
    {


        $userID = $_POST['userID'];
        $storeName = $_POST['storeName'];
        $review = $_POST['review'];
        $menu = $_POST['menu'];
        $starRating = $_POST['starRating'];

        if(empty($userID)){
            $errMSG = "이름을 입력하세요.";
        }
        else if(empty($storeName)){
            $errMSG = "가게이름을 입력하세요.";
        }
        else if(empty($review)){
            $errMSG = "리뷰를 입력하세요.";
        }
        else if(empty($menu)){
            $errMSG = "메뉴를 입력하세요.";
        }
        else if(empty($starRating)){
            $errMSG = "별점을 입력하세요.";
        }

        if(!isset($errMSG))
        {
            try{
                $stmt = $con->prepare('INSERT INTO Review (userID,storeName,review,menu,starRating) 
                VALUES(:userID, :storeName, :review, :menu, $starRating,NOW())');
                $stmt->bindParam(':userID', $userID);
                $stmt->bindParam(':storeName', $storeName);
                $stmt->bindParam(':review', $review);
                $stmt->bindParam(':menu', $menu);
                $stmt->bindParam(':starRating', $starRating,PDO::PARAM_INT);

                if($stmt->execute())
                {
                    $successMSG = "새로운 리뷰를 추가했습니다.";
                }
                else
                {
                    $errMSG = "에러";
                }

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

                ID:<input type="text" name="userID" required><br><br>
                가게:<input type="text" name="storeName" required><br><br>
                리뷰<br><textarea name="review" cols = "30" rows = "5" placeholder="리뷰를 남겨주세요." required></textarea><br><br>
                메뉴:<input type="text" name="menu" required><br><br>
                별점:<input type="number" min = "0" max = "5" name="starRating" required><br><br>
                <input type = "submit" name = "submit" />
            </form>
       
       </body>
    </html>

<?php 
    }
?>