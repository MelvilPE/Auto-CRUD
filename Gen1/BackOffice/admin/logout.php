<?php
    require_once $_SERVER["DOCUMENT_ROOT"]."/sessions/sessions.php";
    session_start();
    $_SESSION[SessionKeys::USER_CONNECTED] = "";
    $_SESSION[SessionKeys::USER_CATEGORY_ID] = "";
    $_SESSION[SessionKeys::USER_NAME] = "";
    $_SESSION[SessionKeys::USER_ID] = "";
    session_destroy();
    header("location: /admin/login.php");
?>