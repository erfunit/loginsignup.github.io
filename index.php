<?php
$errors = [];
function request($field)
{
    return isset($_POST[$field]) && $_POST[$field] !== "" ? trim($_POST[$field]) : null;
}

function has_error($field)
{
    global $errors;
    return isset($errors[$field]);
}

function get_error($field)
{
    global $errors;
    return has_error($field) ? $errors[$field] : null;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username=request("username");
    $password=request("password");
    $username2 = request("username2");
    $fname = request("fname");
    $lname = request("lname");
    $email = request("email");
    $pass = request("pass");
    $cpass2 = request("cpass2");
    if (is_null($username)){
        $errors['username']='username cannot be empty';
    }
    if (is_null($password)){
        $errors['password']='password cannot be empty';
    }elseif (strlen($password) < 8) {
        $errors['password'] = 'Password should be at least 8 characters long';
    }
    if (is_null($username2)) {
        $errors['username2'] = 'Username cannot be empty';
    }
    if (is_null($fname)) {
        $errors['fname'] = 'First name cannot be empty';
    }
    if (is_null($lname)) {
        $errors['lname'] = 'Last name cannot be empty';
    }
    if (is_null($email)) {
        $errors['email'] = 'Email cannot be empty';
    }
    if (is_null($pass)) {
        $errors['pass'] = 'Password cannot be empty';
    } elseif (strlen($pass) < 8) {
        $errors['pass'] = 'Password should be at least 8 characters long';
    }
    if (is_null($cpass2)) {
        $errors['cpass2'] = 'Confirm password cannot be empty';
    } elseif ($cpass2 !== $pass) {
        $errors['cpass2'] = 'Confirm Password does not match';
    }
    if (
        empty($errors) &&
        !is_null($username2) &&
        !is_null($fname) &&
        !is_null($lname) &&
        !is_null($email) &&
        !is_null($pass) &&
        strlen($pass) >= 8 &&
        !is_null($cpass2) &&
        $cpass2 === $pass
    ) {
        $connect = mysqli_connect('localhost:3306', 'root', '', 'enter');
        if (!$connect) {
            echo 'Could not connect. Error: ' . mysqli_connect_error();
            exit;
        }
        $stmt = mysqli_prepare($connect, "INSERT INTO users (id,username,fname, lname, email, password) VALUES (null,?, ?, ?, ?, ?)");
        $hashedPassword = password_hash($pass, PASSWORD_DEFAULT);
        mysqli_stmt_bind_param($stmt, "sssss", $username2, $fname, $lname, $email, $hashedPassword);
        if (mysqli_stmt_execute($stmt)) {
            mysqli_stmt_close($stmt);
            mysqli_close($connect);
            header("Location: index.php");
            exit;
        } else {
            echo 'Error: ' . mysqli_stmt_error($stmt);
        }
        mysqli_stmt_close($stmt);
        mysqli_close($connect);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./style.css">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<div class="container">
    <form id="form" action="/" method="POST">
        <label id="form-title">login/signup form</label>
        <div class="login-signup-container">
            <button id="itslogin">login</button>
            <button id="itssignup">signup</button>
        </div>
        <br>
        <!-- for login -->
        <div class="login">
            <input type="text" id="username" placeholder="username" name="username">
            <input type="password" id="password" placeholder="password" name="password">
            <input type="password" id="cpass" placeholder="confirm password" name="cpass">
        </div>
        <!-- for sign up -->
        <div class="singup">
            <input type="text" id="username2" placeholder="username" name="username2">
            <?php if (has_error('username2')) { ?>
                <span class="herror"><?= get_error('username2') ?></span><br>
            <?php } ?>
            <input type="text" id="fname" placeholder="first name" name="fname">
            <?php if (has_error('fname')) { ?>
                <span class="herror"><?= get_error('fname') ?></span><br>
            <?php } ?>
            <input type="text" id="lname" placeholder="last name" name="lname">
            <?php if (has_error('lname')) { ?>
                <span class="herror"><?= get_error('lname') ?></span><br>
            <?php } ?>
            <input type="email" id="email" placeholder="email" name="email">
            <?php if (has_error('email')) { ?>
                <span class="herror"><?= get_error('email') ?></span><br>
            <?php } ?>
            <input type="password" id="pass" placeholder="password" name="pass">
            <?php if (has_error('pass')) { ?>
                <span class="herror"><?= get_error('pass') ?></span><br>
            <?php } ?>
            <input type="password" id="cpass2" placeholder="confirm password" name="cpass2">
            <?php if (has_error('cpass2')) { ?>
                <span class="herror"><?= get_error('cpass2') ?></span><br>
            <?php } ?>
        </div>
        <button id="loginBtn" type="submit">Sign Up</button>
        <br/>
    </form>
</div>
<script src="./app.js"></script>
</body>
</html>