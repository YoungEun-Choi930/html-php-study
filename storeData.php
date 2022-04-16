<?php
    $db = mysqli_connect('localhost','root','admin','test');
    if(!$db) { die("fail");   }
    $query = "select * from Store";
    $result = mysqli_query($db,$query);

    $resultArray = array();
    while($row = mysqli_fetch_array($result)){
        $insertArray = array();
        $insertArray['storeName'] = $row[storeName];
        $insertArray['address'] = $row[address];
        $insertArray['tel'] = $row[tel];
        $insertArray['type'] = $row[type];
        $insertArray['openingHours'] = $row[openingHours];
        $insertArray['starRatingAvg'] = $row[starRatingAvg];
        $insertArray['latitude'] = $row[latitude];
        $insertArray['longitude'] = $row[longitude];
        array_push($resultArray, $insertArray);
        }
    $output = json_encode($resultArray,JSON_UNESCAPED_UNICODE);
    echo urldecode($output);
    
?>