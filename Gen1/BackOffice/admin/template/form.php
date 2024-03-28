<?php 
    require_once $_SERVER['DOCUMENT_ROOT']."/admin/include/protect.php";
    require_once $_SERVER['DOCUMENT_ROOT']."/admin/include/connect.php";
    
    $user_id = ""; 
    $user_name = ""; 
    $user_password = "";
    $user_date = "";
    $user_category_id = "";
    $machine_id = "";

    if (isset($_GET["user_id"]) && $_GET["user_id"] > 0)
    {
        $sql = "SELECT * FROM table_user 
                WHERE user_id = :user_id";

        $statement = $db->prepare($sql);
        $statement->bindParam(":user_id", $_GET["user_id"]);
        $statement->execute();
        
        if ($row = $statement->fetch())
        {
            $user_id = $row["user_id"]; 
            $user_name = $row["user_name"]; 
            $user_password = $row["user_password"]; 
            $user_date = $row["user_date"]; 
            $user_category_id = $row["user_category_id"]; 
            $machine_id = $row["machine_id"]; 
        }
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form of users</title>
    <link href="/bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <head></head>
    <main>
        <form action="process.php" method="POST">
            <div class="form-group">
                <label for="user_id">Enter user id</label>
                <input class="form-control" id="user_id" placeholder="" name="user_id"
                    value="<?=$user_id;?>">
            </div>
        
            <div class="form-group">
                <label for="user_name">Enter user name</label>
                <input class="form-control" id="user_name" placeholder="" name="user_name"
                    value="<?=$user_name;?>">
            </div>

            <div class="form-group">
                <label for="user_password">Enter user password</label>
                <input class="form-control" id="user_password" placeholder="" name="user_password"
                    value="<?=$user_password;?>">
            </div>

            <div class="form-group">
                <label for="user_date">Enter user date</label>
                <input class="form-control" id="user_date" placeholder="" name="user_date"
                    value="<?=$user_date;?>">
            </div>

            <div class="form-group">
                <label for="user_category_id">Enter user category_id</label>
                <input class="form-control" id="user_category_id" placeholder="" name="user_category_id"
                    value="<?=$user_category_id;?>">
            </div>

            <div class="form-group">
                <label for="machine_id">Enter machine id</label>
                <input class="form-control" id="machine_id" placeholder="" name="machine_id"
                    value="<?=$machine_id;?>">
            </div>

            <button type="submit" class="w-100 btn btn-primary btn-block">Submit</button>
        </form>
    </main>
    <footer></footer>
</body>

</html>