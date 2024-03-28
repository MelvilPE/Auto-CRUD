<?php 
    require_once $_SERVER['DOCUMENT_ROOT']."/admin/include/protect.php";
    require_once $_SERVER['DOCUMENT_ROOT']."/admin/include/connect.php";

    if (isset($_GET["CRUD_PRIMARY_KEY"]) && $_GET["CRUD_PRIMARY_KEY"] > 0)
    {
        $sql = "DELETE FROM CRUD_TABLE_NAME
        WHERE CRUD_PRIMARY_KEY = :CRUD_PRIMARY_KEY";

        $statement = $db->prepare($sql);
        $statement->bindParam(":CRUD_PRIMARY_KEY", $_GET["CRUD_PRIMARY_KEY"]);
        $statement->execute();
    }

    header("location:index.php");
?>