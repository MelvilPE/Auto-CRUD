<?php 
    require_once $_SERVER['DOCUMENT_ROOT']."/admin/include/protect.php"; 
    require_once $_SERVER['DOCUMENT_ROOT']."/admin/include/globals.php"; 
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <title>BlitzTools</title>
</head>

<body>
    <div class="text-center alert alert-success" role="alert">
        <?= "Welcome ".$_SESSION['user_name']; ?>
    </div>
</body>