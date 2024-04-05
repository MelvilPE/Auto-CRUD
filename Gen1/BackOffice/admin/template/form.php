<?php 
    require_once $_SERVER['DOCUMENT_ROOT']."/admin/include/protect.php";
    require_once $_SERVER['DOCUMENT_ROOT']."/admin/include/connect.php";
    
    $CRUD_ALL_PARAMS = ""; 

    if (isset($_GET["CRUD_PRIMARY_KEY"]) && $_GET["CRUD_PRIMARY_KEY"] > 0)
    {
        $sql = "SELECT * FROM CRUD_TABLE_NAME 
                WHERE CRUD_PRIMARY_KEY = :CRUD_PRIMARY_KEY";

        $statement = $db->prepare($sql);
        $statement->bindParam(":CRUD_PRIMARY_KEY", $_GET["CRUD_PRIMARY_KEY"]);
        $statement->execute();
        
        if ($row = $statement->fetch())
        {
            $CRUD_ALL_PARAMS = $row["CRUD_ALL_PARAMS"]; 
        }
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form of CRUD_TABLE_NAME</title>
    <link href="/bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <head></head>
    <main>
        <form action="process.php" method="POST">
            <div class="form-group"><label for="CRUD_ALL_PARAMS">Enter CRUD_ALL_PARAMS</label><input class="form-control" id="CRUD_ALL_PARAMS" placeholder="" name="CRUD_ALL_PARAMS" value="<?=$CRUD_ALL_PARAMS;?>"></div>
            <button type="submit" class="w-100 btn btn-primary btn-block">Submit</button>
        </form>
    </main>
    <footer></footer>
</body>

</html>