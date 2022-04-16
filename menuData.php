<?php
    $db = mysqli_connect('localhost','root','admin','test');
    if(!$db) { die("fail");   }
    $query = "select * from Menu";
    $result = mysqli_query($db,$query);

    $resultArray = array();
    while($row = mysqli_fetch_array($result)){
        $insertArray = array();
        $insertArray['menu'] = $row[menu];
        $insertArray['storeName'] = $row[storeName];
        $insertArray['price'] = $row[price];
        $insertArray['type'] = $row[type];
        
        array_push($resultArray, $insertArray);
        }
    $output = json_encode($resultArray,JSON_UNESCAPED_UNICODE);
    echo urldecode($output);
    
?>