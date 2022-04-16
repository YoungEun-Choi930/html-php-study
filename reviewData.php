<?php
    $db = mysqli_connect('localhost','root','admin','test');
    if(!$db) { die("fail");   }
    $query = "select * from Review";
    $result = mysqli_query($db,$query);

    $resultArray = array();
    while($row = mysqli_fetch_array($result)){
        $insertArray = array();
        $insertArray['userID'] = $row[userID];
        $insertArray['storeName'] = $row[storeName];
        $insertArray['review'] = $row[review];
        $insertArray['menu'] = $row[menu];
        $insertArray['starRating'] = $row[starRating];
        $insertArray['date'] = $row[date];
        array_push($resultArray, $insertArray);
        }
    $output = json_encode($resultArray,JSON_UNESCAPED_UNICODE);
    echo urldecode($output);
    
?>