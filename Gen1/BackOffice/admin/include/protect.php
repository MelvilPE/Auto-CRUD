<?php 
    require_once $_SERVER["DOCUMENT_ROOT"]."/admin/include/globals.php";
    require_once $_SERVER["DOCUMENT_ROOT"]."/users/include/globals.php";
    require_once $_SERVER["DOCUMENT_ROOT"]."/sessions/sessions.php";

    // Check if the user is connected. 
    session_start();
    if (!isset ($_SESSION[SessionKeys::USER_CONNECTED]) || $_SESSION[SessionKeys::USER_CONNECTED] != SessionKeys::SESSION_USER_CONNECTED) {
        header("location: /admin/login.php");
        exit();
    }

    // Checks if the user is an admin and redirects to login if not.
    if (!isset ($_SESSION[SessionKeys::USER_CATEGORY_ID]) || $_SESSION[SessionKeys::USER_CATEGORY_ID] != UserCategoryId::Admin) {
        header("location: /admin/login.php");
        exit();
    }
?>