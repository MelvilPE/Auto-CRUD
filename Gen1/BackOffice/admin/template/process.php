<?php 
    require_once $_SERVER['DOCUMENT_ROOT']."/admin/include/protect.php";
    require_once $_SERVER['DOCUMENT_ROOT']."/admin/include/connect.php";
    
    if (isset($_POST["CRUD_PRIMARY_KEY"]) && $_POST["CRUD_PRIMARY_KEY"] > 0)
    {
        $sql = "UPDATE CRUD_TABLE_NAME SET 
                CRUD_PROCESS_ALL_PARAMS=:CRUD_PROCESS_ALL_PARAMS,
                WHERE CRUD_PRIMARY_KEY=:CRUD_PRIMARY_KEY";
    }
    else
    {
        $sql = "INSERT INTO CRUD_TABLE_NAME (
                    CRUD_PROCESS_ALL_PARAMS,
                )
                VALUES (
                    :CRUD_PROCESS_ALL_PARAMS,
                )";
    }

    $statement = $db->prepare($sql);
    if (isset($_POST["CRUD_PRIMARY_KEY"]) && $_POST["CRUD_PRIMARY_KEY"] > 0)
    {
        $statement->bindParam(":CRUD_PRIMARY_KEY", $_POST["CRUD_PRIMARY_KEY"]);
    }

    if (isset($_POST["CRUD_PROCESS_ALL_END_PARAMS"])) { $statement->bindParam(":CRUD_PROCESS_ALL_END_PARAMS", $_POST["CRUD_PROCESS_ALL_END_PARAMS"]); }
    
    $statement->execute();
    header("location:index.php");
?>