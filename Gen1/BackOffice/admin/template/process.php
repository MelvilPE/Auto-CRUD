<?php 
    require_once $_SERVER['DOCUMENT_ROOT']."/admin/include/protect.php";
    require_once $_SERVER['DOCUMENT_ROOT']."/admin/include/connect.php";
    
    if (isset($_POST["user_id"]) && $_POST["user_id"] > 0)
    {
        $sql = "UPDATE table_user SET 
                user_name=:user_name,
                user_password=:user_password,
                user_date=:user_date,
                user_category_id=:user_category_id,
                machine_id=:machine_id
                WHERE user_id=:user_id";
    }
    else
    {
        $sql = "INSERT INTO table_user (user_name, user_password, user_date, user_category_id, machine_id)
                VALUES (:user_name, :user_password, :user_date, :user_category_id, :machine_id)";
    }

    $statement = $db->prepare($sql);
    if (isset($_POST["user_id"]) && $_POST["user_id"] > 0)
    {
        $statement->bindParam(":user_id", $_POST["user_id"]);
    }
    if (isset($_POST["user_name"]))
    {
        $statement->bindParam(":user_name", $_POST["user_name"]);
    }
    if (isset($_POST["user_password"]))
    {
        $statement->bindParam(":user_password", $_POST["user_password"]);
    }
    if (isset($_POST["user_date"]))
    {
        $statement->bindParam(":user_date", $_POST["user_date"]);
    }
    if (isset($_POST["user_category_id"]))
    {
        $statement->bindParam(":user_category_id", $_POST["user_category_id"]);
    }
    if (isset($_POST["machine_id"]))
    {
        $statement->bindParam(":machine_id", $_POST["machine_id"]);
    }
    
    $statement->execute();
    header("location:index.php");
?>