<?php 
    require_once $_SERVER["DOCUMENT_ROOT"]."/admin/include/connect.php";
    require_once $_SERVER["DOCUMENT_ROOT"]."/admin/include/globals.php";
    require_once $_SERVER["DOCUMENT_ROOT"]."/users/include/globals.php";
    require_once $_SERVER["DOCUMENT_ROOT"]."/sessions/sessions.php";

    $error_message = "";
    if (isset($_POST["user_name"]) && isset($_POST["user_password"]))
    {
        $user_name = $_POST["user_name"];
        $user_password = $_POST["user_password"];
        
        $sql = "SELECT * FROM table_user
        WHERE user_name = :user_name";
        
        $statement = $db->prepare($sql);
        $statement->bindValue(":user_name", $user_name);
        $statement->execute();
        
        $row_user = $statement->fetch();
        if (!$row_user)
        {
            $error_message = "This account doesn't exist!";
            goto SHOW_FORM;
        }

        if (!password_verify($user_password, $row_user["user_password"]))
        {
            $error_message = "The account password is wrong!";
            goto SHOW_FORM;
        }
        
        $user_category_id = $row_user['user_category_id'];
        if ($user_category_id != UserCategoryId::Admin)
        {
            $error_message = "The account is not an admin!";
            goto SHOW_FORM;
        }
        
        session_start();
        $_SESSION[SessionKeys::USER_CONNECTED] = SessionKeys::SESSION_USER_CONNECTED;
        $_SESSION[SessionKeys::USER_CATEGORY_ID] = $user_category_id;
        $_SESSION[SessionKeys::USER_NAME] = $row_user[SessionKeys::USER_NAME];
        $_SESSION[SessionKeys::USER_ID] = $row_user[SessionKeys::USER_ID];
        header("location: index.php");
        exit();

        SHOW_FORM:
    }
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
    <div class="container">
        <div class="d-flex align-items-center justify-content-center min-vh-100">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="text-center">Login</h3>
                    </div>
                    <div class="card-body">
                        <form action="login.php" method="POST">
                            <div class="mb-3">
                                <label for="user_name" class="form-label">User login:</label>
                                <input type="text" class="form-control" name="user_name" id="user_name"
                                    placeholder="Enter your user login">
                            </div>
                            <div class="mb-3">
                                <label for="user_password" class="form-label">User password:</label>
                                <input type="user_password" class="form-control" name="user_password"
                                    id="user_password" placeholder="Enter your user password">
                            </div>
                            <button type="submit" value="ok" class="btn btn-primary btn-block">Login</button>
                            <?php if ($error_message != ""){ ?>
                            <div class="text-center alert alert-danger" role="alert">
                                <?= $error_message; ?>
                            </div>
                            <?php } ?>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>