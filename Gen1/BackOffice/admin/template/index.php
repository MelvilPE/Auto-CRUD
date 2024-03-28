<?php 
    require_once $_SERVER['DOCUMENT_ROOT']."/admin/include/protect.php";
    require_once $_SERVER['DOCUMENT_ROOT']."/admin/include/connect.php";
    
    $sql = "SELECT * FROM table_user
            ORDER BY user_id ASC";

    $statement = $db->prepare($sql);
    $statement->execute();
    $recordset = $statement->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List of users</title>
    <link href="/bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <head></head>
    <h1 class="text-primary">List of users</h1>
    <table class="table table-striped">
        <caption>List of users</caption>
        <tr>
            <th scope="col">User id</th>
            <th scope="col">User name</th>
            <th scope="col">User password</th>
            <th scope="col">User date</th>
            <th scope="col">User category id</th>
            <th scope="col">Machine id</th>
            <th scope="col">
                <a href="form.php">Add new user</a>
            </th>
            <th scope="col"></th>
        </tr>
        <?php foreach ($recordset as $row) { ?>
        <tr>
            <td><?=$row["user_id"];?></td>
            <td><?=$row["user_name"];?></td>
            <td><?=$row["user_password"];?></td>
            <td><?=$row["user_date"];?></td>
            <td><?=$row["user_category_id"];?></td>
            <td><?=$row["machine_id"];?></td>
            <td>
                <a href="delete.php?user_id=<?=$row["user_id"];?>" title="Delete">Delete</a>
            </td>
            <td>
                <a href="form.php?user_id=<?=$row["user_id"];?>" title="Edit">Edit</a>
            </td>
        </tr>
        <?php } ?>
    </table>
    <footer></footer>
</body>

</html>