<?php
    $db = mysqli_connect('localhost','root','admin','test');
    if(!$db) { die("fail");   }
    $query = "select * from User";
    $result = mysqli_query($db,$query);

    $resultArray = array();
    while($row = mysqli_fetch_array($result)){
        $insertArray = array();
        $insertArray['userName'] = $row[userName];
        $insertArray['userID'] = $row[userID];
        array_push($resultArray, $insertArray);
        }
    $output = json_encode($resultArray, JSON_UNESCAPED_UNICODE);
    echo urldecode($output);
    
?>