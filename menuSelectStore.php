<?php  
// https://webnautes.tistory.com/1189 여기 보고 참조
error_reporting(E_ALL); 
ini_set('display_errors',1); 

include('dbcon.php');



$storeName=isset($_POST['storeName']) ? $_POST['storeName'] : '';
$android = strpos($_SERVER['HTTP_USER_AGENT'], "Android");


if ($storeName != "" ){ 

    // 스토어 네임을 입력받아서 해당하는 메뉴만 출력
    $sql="select * from person where storeName='$storeName'";
    $stmt = $con->prepare($sql);
    $stmt->execute();
 
    if ($stmt->rowCount() == 0){

        echo "'";
        echo $storeName;
        echo "'은 찾을 수 없습니다.";
    }
	else{

        // 출력
   		$data = array(); 

        while($row=$stmt->fetch(PDO::FETCH_ASSOC)){

        	extract($row);

            array_push($data, 
                array('menu'=>$row["menu"],
                'storeName'=>$row["storeName"],
                'price'=>$row["price"],
                'menuType'=>$row["menuType"]
            ));
        }


        if (!$android) {
            echo "<pre>"; 
            print_r($data); 
            echo '</pre>';
        }else
        {
            header('Content-Type: application/json; charset=utf8');
            $json = json_encode(array("webnautes"=>$data), JSON_PRETTY_PRINT+JSON_UNESCAPED_UNICODE);
            echo $json;
        }
    }
}
else {
    echo "검색할 가게를 입력하세요 ";
}

?>



<?php

$android = strpos($_SERVER['HTTP_USER_AGENT'], "Android");

if (!$android){
?>

<html>
   <body>
   
      <form action="<?php $_PHP_SELF ?>" method="POST">
         가게이름: <input type = "text" name = "storeName" />
         <input type = "submit" />
      </form>
      <form action="Menu.php" method = "post">
        <input type = "submit" value = "GoBack">
      </form>
   
   </body>
</html>
<?php
}

   
?>