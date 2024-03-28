<?php
    require_once $_SERVER["DOCUMENT_ROOT"]."/admin/include/globals.php";

    $db_host = $DATABASE_HOST;
    $db_name = $DATABASE_NAME;
    $user_name = $DATABASE_USER;
    $user_password = "";
    try
    {
        $db = new PDO("mysql:host=" . $db_host . ";dbname=" . $db_name . ";charset=utf8", $user_name, $user_password);
    }
    catch(Exception $e)
    {
        die("Error: " . $e->getMessage());
    }
?>