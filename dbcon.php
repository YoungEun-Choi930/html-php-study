<?php

$host = 'localhost'; // 데이터베이스 호스트
$username = 'root'; // 데이터베이스 ID (수정요망)
$password = 'admin'; // 데이터베이스 PW (수정요망)
$dbname = 'test'; //데이터베이스명 (수정요망)
 
$options = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');
    
    try {

        $con = new PDO("mysql:host={$host};dbname={$dbname};charset=utf8",$username, $password);
    } catch(PDOException $e) {

        die("Failed to connect to the database: " . $e->getMessage()); 
    }


    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $con->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);


    //데이터베이스에 저장시 '(작은 따옴표)가 들어가서 문제가 생기는 것을 방지하기 위해
    //PHP에서 제공하여 주는 \' 이렇게 처리를 해 주는 좋은 기능입니다.

    //php7.4버전에서는 없어져서 일단 역슬래시가 입력되지 않음을 가정하고 이 코드를 없앰.
    
    // if(function_exists('get_magic_quotes_gpc') && get_magic_quotes_gpc()) { 
    //     function undo_magic_quotes_gpc(&$array) { 
    //         foreach($array as &$value) { 
    //             if(is_array($value)) { 
    //                 undo_magic_quotes_gpc($value); 
    //             } 
    //             else { 
    //                 $value = stripslashes($value); 
    //             } 
    //         } 
    //     } 
 
    //     undo_magic_quotes_gpc($_POST); 
    //     undo_magic_quotes_gpc($_GET); 
    //     undo_magic_quotes_gpc($_COOKIE); 
    // } 
 
    header('Content-Type: text/html; charset=utf-8'); 
    #session_start();
?>