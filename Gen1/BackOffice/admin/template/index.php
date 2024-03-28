<?php 
    require_once $_SERVER['DOCUMENT_ROOT']."/admin/include/protect.php";
    require_once $_SERVER['DOCUMENT_ROOT']."/admin/include/connect.php";
    
    $sql = "SELECT * FROM CRUD_TABLE_NAME
            ORDER BY CRUD_PRIMARY_KEY ASC";

    $statement = $db->prepare($sql);
    $statement->execute();
    $recordset = $statement->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List of CRUD_TABLE_NAME</title>
    <link href="/bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <head></head>
    <h1 class="text-primary">List of CRUD_TABLE_NAME</h1>
    <table class="table table-striped">
        <caption>List of CRUD_TABLE_NAME</caption>
        <tr>
            <th scope="col">CRUD_ALL_PARAMS</th>
            <th scope="col">
                <a href="form.php">Add new CRUD_TABLE_NAME</a>
            </th>
            <th scope="col"></th>
        </tr>
        <?php foreach ($recordset as $row) { ?>
        <tr>
            <td><?=$row["CRUD_ALL_PARAMS"];?></td>
            <td>
                <a href="delete.php?CRUD_PRIMARY_KEY=<?=$row["CRUD_PRIMARY_KEY"];?>" title="Delete">Delete</a>
            </td>
            <td>
                <a href="form.php?CRUD_PRIMARY_KEY=<?=$row["CRUD_PRIMARY_KEY"];?>" title="Edit">Edit</a>
            </td>
        </tr>
        <?php } ?>
    </table>
    <footer></footer>
</body>

</html>