<?php
$username ="";
$email = "";
$age = "";
$password = "";
$confirm_password = "";
$errors = [];

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $username = trim($_POST["username"]);
    $email = trim($_POST["email"]);
    $age = trim($_POST["age"]);
    $password = trim($_POST["password"]);
    $confirm_password = trim($_POST["confirm_password"]);

    if(empty($username)){
        $errors['username'] = "Username is required";
    }
    
    if(empty($email)){
        $errors['email'] = "Email is required";
    }elseif (!filter_var($email , FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Invalid email format";
    }
    if(empty($age)){
        $errors['age'] = "Age is required";
    }elseif (!is_numeric($age)) {
        $errors['age'] = "Age must be a number";
    }elseif ($age < 18) {
        $errors['age'] = "You must be at least 18 years old";
    }

    if(empty($password)){
        $errors['password'] = "Password is required"; 
    }elseif (strlen($password) < 6) {  
        $errors['password'] = "Password must be at least 6 characters long";
    }

    if(empty($confirm_password)){
        $errors['confirm_password'] = "Confirm password is required";
    }elseif ($password !== $confirm_password) {
        $errors['confirm_password'] = "Passwords do not match";
    }

    if(empty($errors)){
        echo "<h3 style='color:green ;'>Form Submition Successfuly</h3>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Form</title>
</head>

<body>
    <h2>
        Register form
    </h2>
    <form method="POST" action='submission.php'>
        <div>
            <label for="username">username</label>
            <input type="text" name="username" id="username" value="<?= htmlspecialchars($username) ?>">
        </div>
        <div>
            <?php if(isset($errors['username'])) : ?>
            <p style="color: red;"><?=$errors['username']?></p>
            <?php endif; ?>
        </div>
        <div>
            <label for="email">email</label>
            <input type="email" name="email" id="email" value="<?= htmlspecialchars($email) ?>">
        </div>
        <div>
            <?php if(isset($errors['email'])) : ?>
            <p style="color: red;"><?=$errors['email']?></p>
            <?php endif; ?>
        </div>
        <div>
            <label for="age">age</label>
            <input type="number" name="age" id="age" value="<?= htmlspecialchars($age) ?>">
        </div>
        <div>
            <?php if(isset($errors['age'])) : ?>
            <p style="color: red;"><?=$errors['age']?></p>
            <?php endif; ?>
        </div>
        <div>
            <label for="password">password</label>
            <input type="password" name="password" id="password">
        </div>
        <div>
            <?php if(isset($errors['password'])) : ?>
            <p style="color: red;"><?=$errors['password']?></p>
            <?php endif; ?>
        </div>
        <div>
            <label for="confirm_password">confirm password</label>
            <input type="password" name="confirm_password" id="confirm_password">
        </div>
        <div>
            <?php if(isset($errors['confirm_password'])) : ?>
            <p style="color: red;"><?=$errors['confirm_password']?></p>
            <?php endif; ?>
        </div>
        <div>
            <button type="submit">Submit</button>
        </div>
    </form>

</body>

</html>