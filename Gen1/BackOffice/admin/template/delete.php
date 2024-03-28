<?php 
    require_once $_SERVER['DOCUMENT_ROOT']."/admin/include/protect.php";
    require_once $_SERVER['DOCUMENT_ROOT']."/admin/include/connect.php";

    if (isset($_GET["user_id"]) && $_GET["user_id"] > 0)
    {
        $sql = "DELETE FROM table_user
        WHERE user_id = :user_id";

        $statement = $db->prepare($sql);
        $statement->bindParam(":user_id", $_GET["user_id"]);
        $statement->execute();
    }

    header("location:index.php");
?>